<?php

namespace Tests\Feature;

use App\Models\Estadi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class EstadiCrudFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // ✅ Autoritza tot en tests (evitem policies)
        Gate::before(fn () => true);
    }

    public function test_es_pot_llistar_estadis()
    {
        $u = User::factory()->create();
        $this->actingAs($u);

        Estadi::factory()->create(['nom' => 'Camp Nou']);
        Estadi::factory()->create(['nom' => 'Santiago Bernabéu']);

        $resp = $this->get('/estadis');
        $resp->assertStatus(200);
        $resp->assertSee('Camp Nou');
        $resp->assertSee('Santiago Bernabéu');
    }

    public function test_es_pot_crear_un_estadi()
    {
        $u = User::factory()->create([
            'role' => 'administrador',
            'email_verified_at' => now(),
        ]);
        $this->actingAs($u);

        $resp = $this->from(route('estadis.create'))
            ->post('/estadis', [
                'nom' => 'Mestalla',
                'capacitat' => 49000,
            ]);

        $resp->assertSessionHasNoErrors();
        $resp->assertRedirect(route('estadis.index'));

        $this->assertDatabaseHas('estadis', [
            'nom' => 'Mestalla',
            'capacitat' => 49000,
        ]);
    }

    public function test_es_pot_actualitzar_un_estadi()
    {
        $u = User::factory()->create([
            'role' => 'manager',
            'email_verified_at' => now(),
        ]);
        $this->actingAs($u);

        $estadi = Estadi::factory()->create([
            'nom' => 'Antic Nom',
            'capacitat' => 30000,
        ]);

        $resp = $this->from(route('estadis.edit', $estadi))
            ->put("/estadis/{$estadi->id}", [
                'nom' => 'Nou Nom',
                'capacitat' => 35000,
            ]);

        $resp->assertSessionHasNoErrors();
        $resp->assertRedirect(route('estadis.index'));

        $this->assertDatabaseHas('estadis', [
            'id' => $estadi->id,
            'nom' => 'Nou Nom',
            'capacitat' => 35000,
        ]);
    }

    public function test_es_pot_esborrar_un_estadi()
    {
        $u = User::factory()->create([
            'role' => 'administrador',
            'email_verified_at' => now(),
        ]);
        $this->actingAs($u);

        $estadi = Estadi::factory()->create(['nom' => 'Estadi a esborrar']);

        $resp = $this->from(route('estadis.index'))
            ->delete("/estadis/{$estadi->id}");

        $resp->assertSessionHasNoErrors();
        $resp->assertRedirect(route('estadis.index'));

        $this->assertDatabaseMissing('estadis', [
            'id' => $estadi->id,
        ]);
    }
}
