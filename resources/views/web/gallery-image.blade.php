@extends('layouts.web.master')

@section('content')

<!-- Gallery Image Viewer -->
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl">

        <!-- Header with Back Button -->
        <div class="mb-6 flex items-center justify-between">
            <button
                onclick="history.back()"
                class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-lg shadow-sm border border-gray-200 transition-all duration-200 transform hover:scale-105 hover:shadow-md group"
            >
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Gallery
            </button>

            <div class="flex space-x-3">
                <!-- Open in Modal Button -->
                <button
                    onclick="openInModal()"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 hover:shadow-md"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                    </svg>
                    View in Modal
                </button>

                <!-- Download Button -->
                <a
                    href="{{ $imageUrl }}"
                    download="{{ $filename }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105 hover:shadow-md"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download
                </a>
            </div>
        </div>

        <!-- Image Display -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="relative group">
                <!-- Main Image -->
                <div class="relative bg-gray-100 flex items-center justify-center p-8">
                    <img
                        src="{{ $imageUrl }}"
                        alt="{{ $filename }}"
                        class="max-w-full max-h-[70vh] object-contain rounded-lg shadow-lg transition-transform duration-300 group-hover:scale-105 cursor-pointer"
                        onclick="openInModal()"
                        id="main-image"
                    >

                    <!-- Hover Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 rounded-lg flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-4 group-hover:translate-y-0">
                            <div class="bg-white bg-opacity-90 backdrop-blur-sm rounded-full p-4 shadow-lg">
                                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Info -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $filename }}</h3>
                            <p class="text-sm text-gray-600 mt-1">Click image to view in modal</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Gallery Image</p>
                            <p class="text-xs text-gray-500">Right-click to save</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Actions -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 mb-4">
                This image is part of our gallery collection. Use the buttons above to navigate or download.
            </p>

            <!-- Share Options -->
            <div class="flex justify-center space-x-4">
                <button
                    onclick="shareImage()"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:scale-105"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                    </svg>
                    Share
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Image Viewing -->
<div id="image-modal" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 flex items-center justify-center p-4">
    <div class="relative max-w-5xl max-h-full">
        <!-- Close Button -->
        <button
            onclick="closeModal()"
            class="absolute -top-12 right-0 w-10 h-10 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full flex items-center justify-center text-white transition-all duration-200 z-60"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Modal Image -->
        <img
            id="modal-image"
            src=""
            alt=""
            class="max-w-full max-h-full object-contain"
        >

        <!-- Image Info in Modal -->
        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-70 text-white p-4">
            <p class="text-sm">{{ $filename }}</p>
        </div>
    </div>
</div>

<script>
function openInModal() {
    const modal = document.getElementById('image-modal');
    const modalImage = document.getElementById('modal-image');
    const mainImage = document.getElementById('main-image');

    modalImage.src = mainImage.src;
    modalImage.alt = mainImage.alt;
    modal.classList.remove('hidden');

    // Prevent background scrolling
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('image-modal');
    modal.classList.add('hidden');

    // Restore background scrolling
    document.body.style.overflow = 'auto';
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Close modal on outside click
document.getElementById('image-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

function shareImage() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $filename }}',
            text: 'Check out this gallery image',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Link copied to clipboard!');
        });
    }
}
</script>

<style>
/* Additional modal styling */
#image-modal {
    backdrop-filter: blur(2px);
}

/* Smooth transitions */
#image-modal img {
    transition: transform 0.3s ease;
}

#image-modal img:hover {
    transform: scale(1.02);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .max-w-4xl {
        max-width: 100%;
    }

    #image-modal img {
        max-height: 80vh;
    }
}
</style>

@endsection
