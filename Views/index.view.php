

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="m-5">
<div>
    <nav id="header" class="w-full z-30 top-5 py-1 bg-white shadow-lg border-b border-teal-300 mt-3">
        <div class="w-full mt-0 px-6 py-2 justify-center flex items-center">
            <label for="menu-toggle" class="cursor-pointer md:hidden block">
                <svg class="fill-current text-blue-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <title>menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                </svg>
            </label>
            <input class="hidden" type="checkbox" id="menu-toggle">
            <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
                <nav>
                    <ul class="md:flex items-center justify-between text-base text-blue-600 pt-4 md:pt-0">
                        <li><a class="inline-block no-underline hover:text-black font-medium text-lg py-2 px-4 lg:-ml-2" href="/?topic=Sport">Sport</a></li>
                        <li><a class="inline-block no-underline hover:text-black font-medium text-lg py-2 px-4 lg:-ml-2" href="/?topic=Stocks">Stocks</a></li>
                        <li><a class="inline-block no-underline hover:text-black font-medium text-lg py-2 px-4 lg:-ml-2" href="/?topic=eSport">E-Sport</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </nav>
    <div class="w-full my-2.5">
        <div class="flex justify-center ">
            <form action="/" class="w-3/5">
                <input type="text" id="fname" name="topic" placeholder=" Topic" class="h-10 w-full rounded-lg shadow-lg border-solid border-2 focus:border-teal-300"><br>
                <input type="submit" value="Submit" class="w-full bg-teal-300 p-1 mt-1 rounded-lg">
            </form>
        </div>
    </div>
</div>



<div class="grid grid-rows-3 grid-flow-col gap-4 justify-center">
    {% for article in articles %}

    <div class="shadow-lg border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-teal-300 rounded-b lg:rounded-b-none lg:rounded-r">
        <div class="max-w-sm w-full lg:max-w-full lg:flex">
            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{  article.getUrlToImage | default("http://localhost:8000/No_Image_Available.jpeg") }}')">
            </div>
            <div class="bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                    <div class="text-gray-900 font-bold text-xl mb-2" ><a class="underline hover:underline-offset-4" href="{{article.getUrlToArticle }}" target="_blank">{{article.getTitle}}</a></div>
                    <p class="text-gray-700 text-base">{{article.getDescription}}</p>
                </div>
                <div class="flex items-center">
                    <div class="text-sm">
                        <p class="text-gray-900 leading-none">
                            {% if article.getAuthor is null %}
                            {{article.getSource}}
                            {% else %}
                            {{article.getAuthor}}
                            {% endif %}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {% endfor %}

</div>
</body>
</html>