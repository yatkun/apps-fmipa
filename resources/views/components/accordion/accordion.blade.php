<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button fw-medium collapsed" type="button"
            data-bs-toggle="collapse" data-bs-target="#flush-{{ $id }}"
            aria-expanded="false" aria-controls="flush-collapseOne">
            {{ $title }}
        </button>
    </h2>
    <div id="flush-{{ $id }}" class="accordion-collapse collapse"
        aria-labelledby="flush-headingOne"
        data-bs-parent="#accordionFlushExample" style="">
        <div class="accordion-body text-muted">
            {{$slot}}


        </div>
    </div>
</div>