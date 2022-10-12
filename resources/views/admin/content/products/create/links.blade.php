<div class="bs-stepper-header">
    <div class="step crossed" data-target="#account-details-modern" role="tab" id="account-details-modern-trigger">
        <button type="button" class="step-trigger" aria-selected="false">
            <span class="bs-stepper-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-medium-3"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            </span>
            <span class="bs-stepper-label">
                <span class="bs-stepper-title">Product Details</span>
                <span class="bs-stepper-subtitle">Setup Product Details</span>
            </span>
        </button>
    </div>
    <div class="line">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
    </div>
    <div class="step crossed" data-target="#personal-info-modern" role="tab" id="personal-info-modern-trigger">
        <button type="button" class="step-trigger" aria-selected="false">
            <span class="bs-stepper-box">
                <i data-feather="layers"></i>
            </span>
            <span class="bs-stepper-label">
                <span class="bs-stepper-title">Stock Details</span>
                <span class="bs-stepper-subtitle">Stock, Return, Offers</span>
            </span>
        </button>
    </div>
    <div class="line">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
    </div>
    <div class="step" data-target="#images-details-modern" role="tab" id="images-details-modern-trigger">
        <button type="button" class="step-trigger" aria-selected="true">
        <span class="bs-stepper-box">
            <i data-feather="image"></i>
        </span>
            <span class="bs-stepper-label">
                <span class="bs-stepper-title">Product Images</span>
                <span class="bs-stepper-subtitle">Upload Product Images </span>
            </span>
        </button>
    </div>

    @if(config('setting.pricing'))
        <div class="step ml-2" data-target="#attributes-details-modern" role="tab" id="attributes-details-modern-trigger">
            <button type="button" class="step-trigger" aria-selected="true">
        <span class="bs-stepper-box">
            <i data-feather="box"></i>
        </span>
                <span class="bs-stepper-label">
                <span class="bs-stepper-title">Attributes</span>
                <span class="bs-stepper-subtitle">Select Product Attributes </span>
            </span>
            </button>
        </div>
    @endif

    <div class="line">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
    </div>
    <div class="step" data-target="#product-type-modern" role="tab" id="product-type-modern-trigger">
        <button type="button" class="step-trigger" aria-selected="false">
            <span class="bs-stepper-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link font-medium-3"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
            </span>
            <span class="bs-stepper-label">
                <span class="bs-stepper-title">Main Information</span>
                <span class="bs-stepper-subtitle">Brand, Category, Company</span>
            </span>
        </button>
    </div>

    <div class="step" data-target="#product-meta" role="tab" id="product-meta-trigger">
        <button type="button" class="step-trigger" aria-selected="false">
            <span class="bs-stepper-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link font-medium-3"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
            </span>
            <span class="bs-stepper-label">
                <span class="bs-stepper-title">Seo Info</span>
                <span class="bs-stepper-subtitle">Meta Title - Description, Meta Keywords </span>
            </span>
        </button>
    </div>
</div>
