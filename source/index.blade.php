@extends('_layouts.master')

@section('body')
<section class="container max-w-2xl mx-auto px-6 py-10 md:py-12">
    <div class="flex flex-col-reverse mb-10 lg:flex-row lg:mb-24">
        <div class="mt-8">
            <h1 id="intro-docs-template">{{ $page->siteName }}</h1>

            <h2 id="intro-powered-by-jigsaw" class="font-light mt-4">{{ $page->siteDescription }}</h2>

            <p class="text-lg">Tasks and sequential workflows made easy <br class="hidden sm:block">with simple and extensible recipes.</p>

            <div class="flex my-10">
                <a href="/docs/getting-started" title="{{ $page->siteName }} getting started" class="bg-red hover:bg-red-dark font-normal text-white hover:text-white rounded mr-4 py-2 px-6">Get Started</a>

                <a href="https://github.com/recipe-runner" title="Source code on Github" class="bg-grey-light hover:bg-grey-dark text-blue-darkest font-normal hover:text-white rounded py-2 px-6">Source code</a>
            </div>
        </div>

        <div class="mx-auto mb-6 lg:mb-0">
        <img src="/assets/img/recipe.svg" alt="{{ $page->siteName }} large logo">
        </div>
    </div>

    <hr class="block my-8 border lg:hidden">

    <div class="md:flex -mx-2 -mx-4">
        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-code.svg" class="h-12 w-12" alt="window icon">

            <h3 class="text-2xl text-red mb-0">Recipes using <br>YAML syntax</h3>

            <p>
                Recipe files use a clean and very simple language based on YAML
                that allows expressions, conditions and loops.
            </p>
        </div>

        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-terminal.svg" class="h-12 w-12" alt="terminal icon">

            <h3 class="text-2xl text-red mb-0">Run recipes with <br>RR command</h3>

            <p>
                With a simple command interface you will be able to run any recipe. RR is your hero
                <code>$ rr run recipe.rr.yml</code>
            </p>
        </div>

        <div class="mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-box-open.svg" class="h-12 w-12" alt="stack icon">

            <h3 id="intro-mix" class="text-2xl text-red mb-0">Extensible with <br>modules</h3>

            <p>
                Modules add new capabilities to recipes. They are PHP classes distributed through
                <b>Packagist</b>.
            </p>
        </div>
    </div>
    
</section>
@endsection
