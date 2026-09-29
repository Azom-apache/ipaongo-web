@include('layouts.web.header')

<div class="max-w-7xl mx-auto px-4 py-12">
    <!-- Modern Title -->
    <div class="text-center mb-12">
        <h2 class="text-gray-900 text-3xl lg:text-4xl font-bold tracking-wide relative inline-block">
            Project Gallery
            <!-- Modern gradient underline -->
            {{-- <span class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-full"></span> --}}
            <!-- Decorative elements -->
            <div class="flex items-center justify-center mt-4 space-x-2">
                <div class="w-8 h-0.5 bg-blue-500 rounded"></div>
                <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                <div class="w-8 h-0.5 bg-pink-500 rounded"></div>
            </div>
        </h2>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-12">
        @foreach ($gallery as $item)
            <div class="group">
                <div
                    onclick="openGalleryModal('{{ asset('images/gallery/' . $item->image) }}', '{{ $item->title }}')"
                    class="block bg-white rounded-2xl shadow-sm hover:shadow-xl hover:shadow-gray-200/50 transition-all duration-500 overflow-hidden transform hover:-translate-y-1 hover:scale-[1.02] border border-gray-100 hover:border-blue-200 cursor-pointer"
                >
                    <!-- Image Container -->
                    <div class="relative overflow-hidden">
                        <div class="aspect-[5/3] bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-3">
                            <img
                                src="{{ asset('images/gallery/' . $item->image) }}"
                                alt="{{ $item->title }}"
                                class="w-full h-full object-cover rounded-xl transition-transform duration-700 group-hover:scale-105"
                            >
                        </div>
                        <!-- Hover overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <!-- Play button overlay for gallery -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-10">
                            <div class="bg-white/90 backdrop-blur-sm rounded-full p-3 shadow-lg shadow-black/50">
                                <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4 text-center">
                        <h6 class="text-gray-700 font-semibold text-sm group-hover:text-blue-900 transition-colors duration-300 leading-tight">
                            {{ $item->title }}
                        </h6>
                    </div>

                    <!-- Animated bottom border -->
                    <div class="h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-4">
            {{ $gallery->links() }}
        </div>
    </div>
</div>

<!-- Gallery Image Modal -->
<div id="gallery-modal" class="fixed inset-0 bg-black bg-opacity-95 hidden z-50 flex items-center justify-center p-4">
    <div class="relative max-w-6xl max-h-full w-full">

        <!-- Close Button -->
        <button
            onclick="closeGalleryModal()"
            class="absolute -top-16 right-0 w-12 h-12 bg-white hover:bg-gray-100 rounded-full flex items-center justify-center text-gray-900 transition-all duration-200 shadow-lg hover:shadow-xl z-60"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Modal Image Container -->
        <div class="relative bg-gray-900 rounded-2xl overflow-hidden shadow-2xl">
            <img
                id="modal-gallery-image"
                src=""
                alt=""
                class="w-full h-auto max-h-[80vh] object-contain"
            >

            <!-- Image Info Overlay -->
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-6">
                <div class="flex items-center justify-between text-white">
                    <div>
                        <h3 id="modal-image-title" class="text-xl font-bold mb-1">Image Title</h3>
                        <p class="text-gray-300 text-sm">Click outside or press ESC to close</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3">
                        <a
                            id="download-modal-image"
                            href=""
                            download
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows (for future implementation) -->
        <button class="absolute left-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all duration-200 opacity-75 hover:opacity-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button class="absolute right-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all duration-200 opacity-75 hover:opacity-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>
</div>

{{-- Gallery Modal Functions --}}
<script>
function openGalleryModal(imageSrc, imageTitle) {
    const modal = document.getElementById('gallery-modal');
    const modalImage = document.getElementById('modal-gallery-image');
    const modalTitle = document.getElementById('modal-image-title');
    const downloadLink = document.getElementById('download-modal-image');

    // Remove loaded attribute to show loading state
    modalImage.removeAttribute('loaded');

    // Set image source and title
    modalImage.src = imageSrc;
    modalTitle.textContent = imageTitle || 'Gallery Image';

    // Set download link
    downloadLink.href = imageSrc;

    // Show modal
    modal.classList.remove('hidden');
    document.body.classList.add('modal-open');

    // Handle image load
    modalImage.onload = function() {
        this.setAttribute('loaded', 'true');
        this.style.opacity = '1';
    };

    // Add fade-in animation
    modalImage.style.opacity = '0';
}

function closeGalleryModal() {
    const modal = document.getElementById('gallery-modal');
    const modalImage = document.getElementById('modal-gallery-image');

    // Add fade-out animation
    modalImage.style.opacity = '0';

    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.classList.remove('modal-open');
    }, 200);
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('gallery-modal');
        if (!modal.classList.contains('hidden')) {
            closeGalleryModal();
        }
    }
});

// Close modal on outside click
document.addEventListener('click', function(e) {
    const modal = document.getElementById('gallery-modal');
    if (e.target === modal && !modal.classList.contains('hidden')) {
        closeGalleryModal();
    }
});
</script>

{{-- Fancybox Init --}}
<script>
    $(document).ready(function () {
        $('[data-fancybox="gallery"]').fancybox({
            buttons: [
                "zoom",
                "slideShow",
                "fullScreen",
                "thumbs",
                "close"
            ],
            loop: true,
            animationEffect: "fade"
        });
    });
</script>

@include('layouts.web.footer')

<style>
/* Gallery Modal Enhancements */
#gallery-modal {
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
}

/* Modal Image Animations */
#modal-gallery-image {
    transition: opacity 0.3s ease;
}

/* Modal Close Button */
#gallery-modal button:hover {
    transform: scale(1.05);
}

/* Responsive Modal */
@media (max-width: 768px) {
    #gallery-modal .max-w-6xl {
        max-width: 95vw;
    }

    #modal-gallery-image {
        max-height: 70vh;
    }

    /* Move close button for mobile */
    #gallery-modal button.absolute.-top-16 {
        top: 16px;
        right: 16px;
        width: 40px;
        height: 40px;
    }
}

/* Loading state for modal image */
#modal-gallery-image {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200px 100%;
    animation: shimmer 1.5s infinite;
}

#modal-gallery-image[loaded] {
    animation: none;
    background: none;
}

/* Ensure modal appears above everything */
#gallery-modal {
    z-index: 99999;
}

/* Smooth transitions */
#gallery-modal > div {
    animation: modalFadeIn 0.3s ease-out;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Hide scrollbars during modal */
body.modal-open {
    overflow: hidden;
}

/* Enhanced button hover effects */
#gallery-modal button:hover svg {
    transform: rotate(90deg);
    transition: transform 0.2s ease;
}
</style>
