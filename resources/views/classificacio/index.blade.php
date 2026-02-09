<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Classificació
        </h2>
    </x-slot>

    <div class="py-6 index-classificacio">
        <div class="max-w-7xl mx-auto px-4">

            <div id="alerta"
                class="hidden mb-4 p-2 border rounded text-sm">
                Classificació actualitzada en temps real ✅
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="p-3">Pos</th>
                            <th class="p-3">Equip</th>
                            <th class="p-3">Punts</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($equips as $equip)
                        <tr data-equip-id="{{ $equip->id }}" class="border-b">
                            <td class="p-3 font-semibold">
                                {{ $posicions[$equip->id] ?? '-' }}
                            </td>
                            <td class="p-3">
                                {{ $equip->nom }}
                            </td>
                            <td class="p-3 font-semibold">
                                {{ $punts[$equip->id] ?? 0 }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        window.addEventListener('classificacio-delta', (ev) => {
            // alerta
            const a = document.getElementById('alerta');
            if (a) {
                a.classList.remove('hidden');
                setTimeout(() => a.classList.add('hidden'), 2500);
            }

            // colors
            (ev.detail || []).forEach(item => {
                const row = document.querySelector(`[data-equip-id="${item.equip_id}"]`);
                if (!row) return;

                row.classList.remove('puja', 'baixa');
                if (item.delta > 0) row.classList.add('puja');
                if (item.delta < 0) row.classList.add('baixa');
            });
        });
    </script>

    <style>
        .puja {
            background: #d1fae5;
        }

        /* verd clar */
        .baixa {
            background: #fee2e2;
        }

        /* roig clar */
    </style>
</x-app-layout>