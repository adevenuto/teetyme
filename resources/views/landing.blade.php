<!doctype html>
<html>
    <head>
        @include('partials.layout.head')
    </head>
    <body>
        <div id="app" class="h-screen">
            <router-view></router-view>
        </div>
        @include('partials.layout.scripts')
    </body>
</html>