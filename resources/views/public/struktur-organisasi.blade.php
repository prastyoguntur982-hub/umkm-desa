@extends('layouts.public')

@section('content')
    <div>
        <h2 class="org-header mt-12" style="font-family: 'Poppins', sans-serif;">Struktur Organisasi</h2>
    </div>

    <div id="chart-container" style="font-family: 'Poppins', sans-serif;">

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/js/jquery.orgchart.min.js"></script>

    <script>
        const flatData = @json($flatData);
        const storageBaseUrl = "{{ asset('storage') }}";

        function buildTree(data, parentId = null) {
            return data
                .filter(item => item.parent_id == parentId)
                .map(item => {
                    const children = buildTree(data, item.id);
                    return children.length ? {
                        ...item,
                        children
                    } : {
                        ...item
                    };
                });
        }

        function nodeTemplate(data) {
      const fotoSrc = data.foto ? `${storageBaseUrl}/${data.foto}` : `/img/no_profile.png`;

  return `
  <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md dark:shadow-lg hover:shadow-lg transition-all duration-300 w-full max-w-md text-center">
    <img src="${fotoSrc}" alt="${data.nama}"
      class="w-24 h-24 rounded-full mx-auto mb-4 shadow-sm dark:shadow-md ring-2 ring-gray-200 dark:ring-gray-600 object-cover">
    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100">${data.jabatan.toUpperCase()}</h2>
    <p class="text-gray-700 dark:text-gray-300">${data.nama}</p>
    <p class="text-gray-500 dark:text-gray-400 text-sm">NIP. ${data.nip}</p>
  </div>
  `;
        }

        $(function() {
            const treeData = buildTree(flatData)[0];
            if (!treeData) {
                $('#chart-container').html(`
        <div class="col-span-full">
            <div class="flex flex-col items-center justify-center py-10 text-center text-gray-600 dark:text-gray-400">
                <x-public.no-data-img />
                <p>Belum ada data.</p>
            </div>
        </div>
    `);
                return;
            }

            // 
            $('#chart-container').orgchart({
                data: treeData,
                nodeTemplate: nodeTemplate,
                pan: true,
                zoom: true
            });
        });
    </script>
@endsection
