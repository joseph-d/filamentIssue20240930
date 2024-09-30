<?php

namespace Tests\Feature;

use App\Filament\Resources\CustomerResource\Pages\CreateCustomer;

use function Pest\Livewire\livewire;

it('advances through the wizard with one `goToNextWizardStep()` call per step', function () {
    livewire(CreateCustomer::class)
        ->assertWizardCurrentStep(1)
        ->fillForm([
            'type' => 'consumer'
        ])
        ->assertFormSet([
            'type' => 'consumer',
        ])
        ->goToNextWizardStep()
        ->assertHasNoFormErrors()
        ->assertWizardCurrentStep(2)
        ->fillForm([
            'email' => 'hello@there.com'
        ])
        ->assertFormSet([
            'email' => 'hello@there.com',
        ])
        ->goToNextWizardStep()
        ->assertHasNoFormErrors()
        ->assertWizardCurrentStep(3)
        ->fillForm([
            'phone' => '123456'
        ])
        ->assertFormSet([
            'phone' => '123456',
        ])
        ->goToNextWizardStep()
        ->assertHasNoFormErrors()
        ->assertWizardCurrentStep(4)
        ->fillForm([
            'github' => 'code123'
        ])
        ->assertFormSet([
            'github' => 'code123',
        ])
        ->call('create')
        ->assertHasNoFormErrors();
});


it('advances through the wizard with extra `goToNextWizardStep()` calls on steps 2 and 3', function () {
    livewire(CreateCustomer::class)
        ->assertWizardCurrentStep(1)
        ->fillForm([
            'type' => 'consumer'
        ])
        ->assertFormSet([
            'type' => 'consumer',
        ])
        ->goToNextWizardStep() // CALL 1
        ->assertHasNoFormErrors()
        ->assertWizardCurrentStep(2)
        ->fillForm([
            'email' => 'hello@there.com'
        ])
        ->assertFormSet([
            'email' => 'hello@there.com',
        ])
        ->goToNextWizardStep() // CALL 1
        ->goToNextWizardStep() // CALL 2
        ->assertHasNoFormErrors()
        ->assertWizardCurrentStep(3)
        ->fillForm([
            'phone' => '123456'
        ])
        ->assertFormSet([
            'phone' => '123456',
        ])
        ->goToNextWizardStep()  // CALL 1
        ->goToNextWizardStep()  // CALL 2
        ->goToNextWizardStep()  // CALL 3
        ->assertHasNoFormErrors()
        ->assertWizardCurrentStep(4)
        ->fillForm([
            'github' => 'code123'
        ])
        ->assertFormSet([
            'github' => 'code123',
        ])
        ->call('create')
        ->assertHasNoFormErrors();
});
