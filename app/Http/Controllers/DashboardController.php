<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Member;
use App\Blog;
use App\News;
use App\Job;
use App\Advertisement;
use App\Project;
use App\Gallery;
use App\Video;
use App\Notice;
use App\Offer;
use App\QuestionAnswer;
use App\Comittee;
use App\Department;
use App\BloodDoner;
use App\Bikroy;
use App\Ad;
use App\Slider;
use App\Tag;
use App\Page;
use App\Stock;
use App\DeliveryOption;
use App\Area;
use App\District;
use App\Upazila;
use App\Role;
use App\Setting;
use App\SiteSetting;
use App\Profile;
use App\Import;

class DashboardController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		try {
			$data = [
				// User Management
				'total_users' => User::count(),
				'total_admins' => User::where('role_id', 1)->count(),
				'total_members' => $this->safeCount('App\Member'),

				// Content Management
				'total_blogs' => $this->safeCount('App\Blog'),
				'total_news' => $this->safeCount('App\News'),
				'total_jobs' => $this->safeCount('App\Job'),
				'total_advertisements' => $this->safeCount('App\Advertisement'),
				'total_projects' => $this->safeCount('App\Project'),
				'total_galleries' => $this->safeCount('App\Gallery'),
				'total_videos' => $this->safeCount('App\Video'),
				'total_notices' => $this->safeCount('App\Notice'),
				'total_offers' => $this->safeCount('App\Offer'),
				'total_sliders' => $this->safeCount('App\Slider'),
				'total_pages' => $this->safeCount('App\Page'),

				// Community
				'total_question_answers' => $this->safeCount('App\QuestionAnswer'),
				'total_committees' => $this->safeCount('App\Comittee'),
				'total_departments' => $this->safeCount('App\Department'),
				'total_blood_donors' => $this->safeCount('App\BloodDoner'),
				'total_bikroys' => $this->safeCount('App\Bikroy'),
				'total_ads' => $this->safeCount('App\Ad'),

				// Inventory
				'total_stocks' => $this->safeCount('App\Stock'),
				'low_stocks' => 0, // Will be calculated if Stock table exists

				// Location
				'total_areas' => $this->safeCount('App\Area'),
				'total_districts' => $this->safeCount('App\District'),
				'total_upazilas' => $this->safeCount('App\Upazila'),

				// System
				'total_roles' => $this->safeCount('App\Role'),
				'total_tags' => $this->safeCount('App\Tag'),
				'total_delivery_options' => $this->safeCount('App\DeliveryOption'),
				'total_profiles' => $this->safeCount('App\Profile'),
				'total_imports' => $this->safeCount('App\Import'),

				// Recent Activity (last 7 days)
				'recent_users' => User::where('created_at', '>=', now()->subDays(7))->count(),
				'recent_blogs' => $this->safeRecentCount('App\Blog'),

				// Today's Activity
				'today_users' => User::whereDate('created_at', today())->count(),
				'today_blogs' => $this->safeTodayCount('App\Blog'),
			];
		} catch (\Exception $e) {
			// Provide default data if database issues occur
			$data = [
				'total_users' => 0,
				'total_admins' => 0,
				'total_members' => 0,
				'total_blogs' => 0,
				'total_news' => 0,
				'total_jobs' => 0,
				'total_advertisements' => 0,
				'total_projects' => 0,
				'total_galleries' => 0,
				'total_videos' => 0,
				'total_notices' => 0,
				'total_offers' => 0,
				'total_sliders' => 0,
				'total_pages' => 0,
				'total_question_answers' => 0,
				'total_committees' => 0,
				'total_departments' => 0,
				'total_blood_donors' => 0,
				'total_bikroys' => 0,
				'total_ads' => 0,
				'total_stocks' => 0,
				'low_stocks' => 0,
				'total_areas' => 0,
				'total_districts' => 0,
				'total_upazilas' => 0,
				'total_roles' => 0,
				'total_tags' => 0,
				'total_delivery_options' => 0,
				'total_profiles' => 0,
				'total_imports' => 0,
				'recent_users' => 0,
				'recent_blogs' => 0,
				'today_users' => 0,
				'today_blogs' => 0,
			];
		}

		return view('admin.dashboard.index', compact('data'));
	}

	private function safeCount($modelClass, $conditions = [])
	{
		try {
			$query = $modelClass::query();
			if (!empty($conditions)) {
				foreach ($conditions as $column => $value) {
					$query->where($column, $value);
				}
			}
			return $query->count();
		} catch (\Exception $e) {
			return 0;
		}
	}

	private function safeRecentCount($modelClass)
	{
		try {
			return $modelClass::where('created_at', '>=', now()->subDays(7))->count();
		} catch (\Exception $e) {
			return 0;
		}
	}

	private function safeTodayCount($modelClass)
	{
		try {
			return $modelClass::whereDate('created_at', today())->count();
		} catch (\Exception $e) {
			return 0;
		}
	}
}
