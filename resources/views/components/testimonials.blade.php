<!-- Testimonials Section with Trustindex -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-white">OUR TESTIMONIALS</h2>
      <p class="lead text-white">What our clients say about us</p>
    </div>

    @php
    $testimonials = [
        [
            'name' => 'Sarah Johnson',
            'role' => 'Marketing Director',
            'company' => 'TechSolutions Inc.',
            'content' => 'Working with this team has been transformative for our business. Their attention to detail and creative approach delivered results beyond our expectations.',
            'rating' => 5,
            'avatar' => 'https://randomuser.me/api/portraits/women/44.jpg'
        ],
        [
            'name' => 'Michael Chen',
            'role' => 'CEO',
            'company' => 'StartUp Ventures',
            'content' => 'Exceptional service from start to finish. They understood our vision perfectly and executed flawlessly. Will definitely work with them again!',
            'rating' => 5,
            'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg'
        ],
        [
            'name' => 'Emma Rodriguez',
            'role' => 'Product Manager',
            'company' => 'Digital Innovations',
            'content' => 'The team delivered our project on time and within budget while maintaining the highest quality standards. Truly professional!',
            'rating' => 4,
            'avatar' => 'https://randomuser.me/api/portraits/women/63.jpg'
        ],
        [
            'name' => 'David Wilson',
            'role' => 'CTO',
            'company' => 'Enterprise Systems',
            'content' => 'Their technical expertise solved complex challenges we were facing. The solutions were innovative and scalable.',
            'rating' => 5,
            'avatar' => 'https://randomuser.me/api/portraits/men/75.jpg'
        ]
    ];
    @endphp

    <div class="row g-4">
      @foreach($testimonials as $testimonial)
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 bg-dark text-white border-0 shadow-sm">
          <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
              <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="rounded-circle me-3" width="50" height="50">
              <div>
                <h4 class="mb-2">{{ $testimonial['name'] }}</h4>
                <small class="text-white">{{ $testimonial['role'] }}, {{ $testimonial['company'] }}</small>
              </div>
            </div>
            <p class="card-text mb-4">"{{ $testimonial['content'] }}"</p>
            <div class="text-warning">
              @for($i = 0; $i < $testimonial['rating']; $i++)
                <i class="fas fa-star"></i>
              @endfor
              @for($i = $testimonial['rating']; $i < 5; $i++)
                <i class="far fa-star"></i>
              @endfor
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>