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
            'name' => 'Anthony Martin',
            'role' => 'Marketing Director',
            'company' => 'TechSolutions Inc.',
            'content' => "Rien à dire, prix attractif, très réactif aux messages, n'essaye pas d'arnaquer lors du retour du véhicule, véhicule très propre. Je n'hésiterais pas à louer chez eux à nouveau.",
            'rating' => 5,
            'avatar' => 'https://lh3.googleusercontent.com/a-/ALV-UjVqD5jmHLIvomdkxvpwsJw-65mMC2Bh-jO-Sn-GJt294S0i4QbY=w72-h72-p-rp-mo-ba2-br100'
        ],
        [
            'name' => 'Karim Kheroua',
            'role' => 'CEO',
            'company' => 'StartUp Ventures',
            'content' => "Top du top. Allez-y les yeux fermé. Voiture en excellent état. Réactif par message. Merci pour votre grand professionnalisme je recommande à 100%",
            'rating' => 5,
            'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocK_Q2dH6ogFvYlaKA2K90-tH9RbmcRECGgU2YTCs-sGt1ADTQ=w72-h72-p-rp-mo-br100'
        ],
        [
            'name' => 'Pierre Sanchez',
            'role' => 'Product Manager',
            'company' => 'Digital Innovations',
            'content' => "Je suis extrêmement satisfait de la qualité du service de livraison proposé.  Le véhicule correspondait parfaitement à la description annoncée, ce qui est très appréciable.  La procédure de restitution s'est déroulée sans accroc et a été adaptée à mes besoins.  C'est une expérience que je recommande vivement.  Merci pour ce professionnalisme exemplaire.",
            'rating' => 5,
            'avatar' => 'https://lh3.googleusercontent.com/a-/ALV-UjVq-fSk7i0J6zPjHRvkPcojG-1SMZ0gG18H-EAgj6tiSEPevc2P-Q=w72-h72-p-rp-mo-ba5-br100'
        ],
        [
            'name' => 'Matej Képeš',
            'role' => 'CTO',
            'company' => 'Enterprise Systems',
            'content' => "Great service, everything went smoothly and communication was spot on! Thank you!",
            'rating' => 5,
            'avatar' => 'https://lh3.googleusercontent.com/a-/ALV-UjXrj1cWMIWU-YBmFt0rc9PlEu5rag8M84nUOPJzmaVbUScVlvTK=w72-h72-p-rp-mo-br100'
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