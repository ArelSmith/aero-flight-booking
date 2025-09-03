<?php

namespace App\Livewire;

use App\Models\PromoCode;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CheckPromoCode extends Component
{
    public $promo_code;
    public $discount = 0;
    public $discount_type;
    public $isValid = false;

    public function checkPromoCode() {
        $promo = $this->findPromoCode($this->promo_code);

        if($promo) {
            $this->applyPromoCode($promo);
        } else {
            $this->invalidatePromoCode();
        }

        $this->dispatchPromoCodeUpdate();
    }

    private function findPromoCode($promoCode) {
        
        return PromoCode::where('code', $promoCode)
            ->where('valid_until', '>=', now())
            ->where('is_used', false)
            ->first();
    }

    private function applyPromoCode($promoCode) {
        $this->isValid = true;
        $this->discount = $promoCode->discount ?? 0;
        $this->discount_type = $promoCode->discount_type;
    }

    private function invalidatePromoCode() {
        $this->isValid = false;
        $this->discount = 0;
        $this->discount_type = null;
    }

    private function dispatchPromoCodeUpdate() {
        $this->dispatch('promoCodeUpdated', [
            'discount' => $this->discount,
            'discount_type' => $this->discount_type,
            'promo_code' => $this->promo_code,
        ]);
    }

    public function render()
    {
        return view('livewire.check-promo-code');
    }
}
