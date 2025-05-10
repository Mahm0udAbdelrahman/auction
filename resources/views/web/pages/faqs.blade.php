@extends('web.layouts.app')
@section('contact')

<section class="faqs-section py-5">
    <div class="container">
        <div class="faqs-details-header text-right">
            <span class="fs-5">{{ __('FAQs') }}</span>
        </div>
        <hr />
        <div class="row mt-5">
            <div class="col-12 mx-auto">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    @foreach ($faqs as $faq)
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                             {{ $faq->question }}
                          </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                          <div class="accordion-body">
                              <span> {{ $faq->answer }} </span>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
            </div>
        </div>

    </div>

</section>

@endsection
