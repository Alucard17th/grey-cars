@props([
    'phone' => '+212 637-967524',
    'message' => 'Hello, I have a question about...',
    'position' => 'bottom-right',
    'text' => 'Chat on WhatsApp',
    'icon' => true,
    'iconClass' => 'bi bi-whatsapp',
    'bgColor' => '#25D366',
    'textColor' => 'white',
    'showMessage' => true,
    'messageText' => 'Chat with us'
])

@php
    // Clean phone number and prepare WhatsApp URL
    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
    $whatsappUrl = "https://wa.me/{$cleanPhone}?text=" . urlencode($message);
@endphp

<div class="whatsapp-widget whatsapp-position-{{ $position }}" 
     style="position: fixed; z-index: 9999;">
    <div class="d-flex align-items-center">
        @if($showMessage)
        <div class="whatsapp-message me-2 p-2 rounded" 
             style="background-color: white; color: #333; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{ $messageText }}
        </div>
        @endif
        
        <a href="{{ $whatsappUrl }}" 
           target="_blank"
           rel="noopener noreferrer"
           class="whatsapp-button d-flex align-items-center justify-content-center"
           style="background-color: {{ $bgColor }}; color: {{ $textColor }}; text-decoration: none;">
            
            @if($icon)
                <i class="{{ $iconClass }}" style="font-size: 32px;"></i>
            @endif
            
        </a>
    </div>
</div>

<style>
    .whatsapp-button {
        padding: 4px 10px;
        border-radius: 50px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        font-weight: 500;
        border: 2px solid #fff;
    }
    
    .whatsapp-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    }
    
    .whatsapp-position-bottom-right {
        bottom: 20px;
        right: 20px;
    }
    
    .whatsapp-position-bottom-left {
        bottom: 20px;
        left: 20px;
    }
    
    .whatsapp-position-top-right {
        top: 20px;
        right: 20px;
    }
    
    .whatsapp-position-top-left {
        top: 20px;
        left: 20px;
    }
    
    .whatsapp-message {
        font-size: 14px;
        font-weight: 500;
        opacity: 0;
        transform: translateX(10px);
        transition: all 0.3s ease;
    }
    
    .whatsapp-widget:hover .whatsapp-message {
        opacity: 1;
        transform: translateX(0);
    }
</style>