<!-- Testimonials Section -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-eyebrow">Testimonials</span>
      <h2 class="fw-bold text-white">What Our Clients Say</h2>
      <p class="text-light opacity-75 mx-auto" style="max-width:560px;">Real stories from travellers who trusted us with their journey across Morocco.</p>
    </div>

    @php
    $testimonials = [
        [
            'name' => 'Anthony Martin',
            'location' => 'France',
            'content' => "Rien à dire, prix attractif, très réactif aux messages, n'essaye pas d'arnaquer lors du retour du véhicule, véhicule très propre. Je n'hésiterais pas à louer chez eux à nouveau.",
            'rating' => 5,
            'avatar' => 'https://lh3.googleusercontent.com/a-/ALV-UjVqD5jmHLIvomdkxvpwsJw-65mMC2Bh-jO-Sn-GJt294S0i4QbY=w72-h72-p-rp-mo-ba2-br100'
        ],
        [
            'name' => 'Karim Kheroua',
            'location' => 'Morocco',
            'content' => "Top du top. Allez-y les yeux fermé. Voiture en excellent état. Réactif par message. Merci pour votre grand professionnalisme je recommande à 100%",
            'rating' => 5,
            'avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocK_Q2dH6ogFvYlaKA2K90-tH9RbmcRECGgU2YTCs-sGt1ADTQ=w72-h72-p-rp-mo-br100'
        ],
        [
            'name' => 'Pierre Sanchez',
            'location' => 'France',
            'content' => "Je suis extrêmement satisfait de la qualité du service. Le véhicule correspondait parfaitement à la description. La restitution s'est déroulée sans accroc. Je recommande vivement.",
            'rating' => 5,
            'avatar' => 'https://lh3.googleusercontent.com/a-/ALV-UjVq-fSk7i0J6zPjHRvkPcojG-1SMZ0gG18H-EAgj6tiSEPevc2P-Q=w72-h72-p-rp-mo-ba5-br100'
        ],
        [
            'name' => 'Matej Képeš',
            'location' => 'Czech Republic',
            'content' => "Great service, everything went smoothly and communication was spot on! Thank you!",
            'rating' => 5,
            'avatar' => 'https://lh3.googleusercontent.com/a-/ALV-UjXrj1cWMIWU-YBmFt0rc9PlEu5rag8M84nUOPJzmaVbUScVlvTK=w72-h72-p-rp-mo-br100'
        ]
    ];
    @endphp

    <div class="row g-4">
      @foreach($testimonials as $testimonial)
      <div class="col-md-6 col-lg-3">
        <article class="testimonial-card">
          <div class="testimonial-quote-mark"><i class="bi bi-quote"></i></div>
          <div class="testimonial-stars" aria-label="{{ $testimonial['rating'] }} out of 5 stars">
            @for($i = 0; $i < $testimonial['rating']; $i++)
              <i class="bi bi-star-fill"></i>
            @endfor
            @for($i = $testimonial['rating']; $i < 5; $i++)
              <i class="bi bi-star"></i>
            @endfor
          </div>
          <p class="testimonial-content">{{ $testimonial['content'] }}</p>
          <div class="testimonial-author">
            <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" loading="lazy">
            <div>
              <h6 class="testimonial-name">{{ $testimonial['name'] }}</h6>
              <span class="testimonial-meta"><i class="bi bi-geo-alt-fill"></i> {{ $testimonial['location'] }}</span>
            </div>
          </div>
        </article>
      </div>
      @endforeach
    </div>

  </div>
</section>
