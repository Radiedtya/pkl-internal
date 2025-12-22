<?php
// app/Http/Requests/UpdateProductRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan melakukan update produk.
     */
    public function authorize(): bool
    {
        // Hanya admin yang boleh update produk
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Aturan validasi untuk data update produk.
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],

            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            // Harga tetap wajib dan minimal 1000
            'price' => ['required', 'numeric', 'min:1000'],

            // Harga diskon opsional & harus < price
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],

            'stock' => ['required', 'integer', 'min:0'],
            'weight' => ['required', 'integer', 'min:1'],

            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],

            // Gambar opsional saat update
            'images' => ['nullable', 'array', 'max:10'],
            'images.*' => [
                'image',
                'mimes:jpg,png,webp',
                'max:2048',
            ],
        ];
    }

    /**
     * Normalisasi data sebelum validasi.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }
}
