<?php

namespace Tests\Unit;

use App\Models\Estadi;
use App\Services\EstadiService;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;
use App\Repositories\BaseRepository;

class EstadiServiceTest extends TestCase
{
    use WithFaker;

    // ✅ Tancar Mockery per evitar warnings
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_guardar_crea_un_estadi()
    {
        $repo = Mockery::mock(BaseRepository::class);

        $data = [
            'nom' => 'Camp Nou',
            'capacitat' => 99000,
        ];

        $repo->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn(new Estadi($data));

        $service = new EstadiService($repo);
        $estadi = $service->guardar($data);

        $this->assertInstanceOf(Estadi::class, $estadi);
        $this->assertEquals('Camp Nou', $estadi->nom);
        $this->assertEquals(99000, $estadi->capacitat);
    }

    public function test_actualitzar_modifica_un_estadi()
    {
        $repo = Mockery::mock(BaseRepository::class);

        $estadi = new Estadi([
            'id' => 1,
            'nom' => 'Antic',
            'capacitat' => 30000,
        ]);

        $repo->shouldReceive('find')->once()->with(1)->andReturn($estadi);
        $repo->shouldReceive('update')
            ->once()
            ->with(1, [
                'nom' => 'Nou',
                'capacitat' => 35000,
            ])
            ->andReturn($estadi);

        $service = new EstadiService($repo);

        $result = $service->actualitzar(1, [
            'nom' => 'Nou',
            'capacitat' => 35000,
        ]);

        $this->assertEquals('Nou', $result->nom);
    }

    public function test_eliminar_un_estadi()
    {
        $repo = Mockery::mock(BaseRepository::class);

        $estadi = new Estadi([
            'id' => 2,
            'nom' => 'Estadi vell',
        ]);

        $repo->shouldReceive('find')->once()->with(2)->andReturn($estadi);
        $repo->shouldReceive('delete')->once()->with(2);

        $service = new EstadiService($repo);
        $service->eliminar(2);

        // Si arriba ací sense excepcions → correcte
        $this->assertTrue(true);
    }
}
