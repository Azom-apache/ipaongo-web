<?php

namespace App\Http\Controllers;

use App\Donation;
use DGvai\SSLCommerz\SSLCommerz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        $donation = Donation::where('tran_id', $request->tran_id)->first();

        if (! $donation || ! $this->amountMatches($donation, $request) || ! SSLCommerz::validate_payment($request)) {
            if ($donation && $donation->payment_status === 'pending') {
                $donation->update([
                    'payment_status' => 'failed',
                    'payment_message' => 'Payment could not be verified.',
                ]);
            }

            return view('web.payment-result', [
                'status' => 'failed',
                'donation' => $donation,
                'message' => 'Payment could not be verified. If money was deducted, contact IPAO with your transaction id.',
            ]);
        }

        $donation = $this->markPaid($request);

        return redirect()->route('payment.receipt', $donation->tran_id);
    }

    public function receipt(string $tranId)
    {
        $donation = Donation::where('tran_id', $tranId)->where('payment_status', 'paid')->firstOrFail();

        return view('web.payment-result', [
            'status' => 'success',
            'donation' => $donation,
            'message' => 'Your donation payment was received.',
        ]);
    }

    public function failure(Request $request)
    {
        $donation = $this->markClosed($request, 'failed');

        return view('web.payment-result', [
            'status' => 'failed',
            'donation' => $donation,
            'message' => $request->input('error', 'The payment was not completed.'),
        ]);
    }

    public function cancel(Request $request)
    {
        $donation = $this->markClosed($request, 'cancelled');

        return view('web.payment-result', [
            'status' => 'cancelled',
            'donation' => $donation,
            'message' => 'You cancelled the payment. No amount was charged.',
        ]);
    }

    public function ipn(Request $request)
    {
        $donation = Donation::where('tran_id', $request->tran_id)->first();

        if ($donation && in_array($request->status, ['VALID', 'VALIDATED'], true) && $this->amountMatches($donation, $request)) {
            if (SSLCommerz::validate_payment($request)) {
                $this->markPaid($request);
            }
        }

        return response('OK');
    }

    private function markPaid(Request $request): Donation
    {
        $donation = Donation::where('tran_id', $request->tran_id)->firstOrFail();

        if ($donation->payment_status === 'paid') {
            return $donation;
        }

        $updated = Donation::where('id', $donation->id)
            ->where('payment_status', '!=', 'paid')
            ->update([
                'payment_status' => 'paid',
                'payment_currency' => $request->input('currency', 'BDT'),
                'paid_amount' => $request->amount,
                'val_id' => $request->val_id,
                'bank_tran_id' => $request->bank_tran_id,
                'card_type' => $request->card_type,
                'card_no' => $request->card_no,
                'card_issuer' => $request->card_issuer,
                'payment_message' => $request->input('status'),
                'paid_at' => now(),
                'donated_at' => now(),
            ]);

        $donation->refresh();

        if ($updated) {
            $this->notifyDonor($donation);
        }

        return $donation;
    }

    private function markClosed(Request $request, string $status): ?Donation
    {
        $donation = Donation::where('tran_id', $request->tran_id)->first();

        if (! $donation || $donation->payment_status === 'paid') {
            return $donation;
        }

        $donation->update([
            'payment_status' => $status,
            'payment_message' => $request->input('error') ?: $request->input('status'),
            'bank_tran_id' => $request->bank_tran_id ?: $donation->bank_tran_id,
            'card_type' => $request->card_type ?: $donation->card_type,
        ]);

        return $donation;
    }

    private function amountMatches(Donation $donation, Request $request): bool
    {
        $expected = number_format((float) $donation->budget, 2, '.', '');
        $received = number_format((float) $request->input('amount', $request->input('currency_amount', 0)), 2, '.', '');

        return $expected === $received && strtoupper((string) $request->input('currency', 'BDT')) === 'BDT';
    }

    private function notifyDonor(Donation $donation): void
    {
        try {
            \Mail::send(
                'email.myTestMail',
                [
                    'title' => 'From donar',
                    'project' => $donation->project_name,
                    'subcat' => $donation->subcat_name,
                    'subsubcat' => $donation->subsubcat_name,
                    'budget' => $donation->budget,
                    'quantity' => $donation->quantity,
                    'usd' => $donation->usd,
                    'donor' => $donation->donor_name,
                    'address' => $donation->address,
                    'country' => $donation->country,
                    'mail' => $donation->email,
                    'contact' => $donation->contact,
                    'tran_id' => $donation->tran_id,
                ],
                function ($message) use ($donation) {
                    $message->from('ipaongo@tutulint.com');
                    $message->to([$donation->email, 'ipaongo@tutulint.com'])->subject('Donor Information');
                }
            );
        } catch (\Throwable $exception) {
            Log::error('Donation payment mail failed: '.$exception->getMessage(), [
                'donation_id' => $donation->id,
            ]);
        }
    }
}
