<x-app-layout>

    <body class="antialiased">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="p-6 lg:p-8 bg-gray-800 bg-opacity-98	 border-b border-gray-200 dark:border-gray-700  sm:rounded-lg">
                    <x-application-logo class="block h-12 w-auto"/>

                    <x-card :title="'The quick brown fox'"
                            :imagePath="'/img/bg.jpeg'"
                            :description="'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis congue lobortis feugiat. Duis ornare a eros vitae ornare. Etiam commodo ultricies urna eu rhoncus. Sed dapibus imperdiet felis. Sed elementum nulla non turpis rhoncus tincidunt.'"></x-card>
                </div>

            </div>
        </div>
    </body>

</x-app-layout>
