<?php

namespace App\Traits;

trait HasLocalizedAttributes
{
    /**
     * Get a localized attribute value.
     * If the current locale is 'th', returns the Thai version if available,
     * otherwise falls back to the English (default) value.
     */
    public function localized(string $attribute): ?string
    {
        if (app()->getLocale() === 'th') {
            $thValue = $this->{ $attribute . '_th'};
            return !empty($thValue) ? $thValue : $this->{ $attribute};
        }

        return $this->{ $attribute};
    }
}
