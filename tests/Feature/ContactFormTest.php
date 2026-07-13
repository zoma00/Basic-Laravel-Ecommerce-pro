<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitors_can_submit_the_contact_form(): void
    {
        $this->post(route('contact.form'), [
            'name' => 'Example Customer',
            'email' => 'customer@example.com',
            'subject' => 'Product enquiry',
            'message' => 'Please send additional product details.',
        ])
            ->assertRedirect(route('contact'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contact_forms', [
            'name' => 'Example Customer',
            'email' => 'customer@example.com',
            'subject' => 'Product enquiry',
        ]);
    }
}
