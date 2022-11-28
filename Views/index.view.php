

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
<div class="grid grid-row-[auto auto] gap-3 justify-center mb-5">
    <div>
        <h1>Your google for news!</h1>
    </div>
    <div>
        <form action="/">
            <input type="text" id="fname" name="topic" placeholder=" Topic" class="rounded-lg shadow-lg border-solid border-2"><br>
            <input type="submit" value="Submit" class="w-full bg-teal-300 p-1 mt-1 rounded-lg">
        </form>
    </div>
</div>

<div class="grid grid-rows-3 grid-flow-col gap-4 justify-center">
    {# @var articles[] App\Models\Article #}
    {% for article in articles %}

    <div class="shadow-lg border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 rounded-b lg:rounded-b-none lg:rounded-r">
        <div class="max-w-sm w-full lg:max-w-full lg:flex">
            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{article.getUrlToImage}}')" title="Woman holding a mug">
            </div>
            <div class="bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                    <div class="text-gray-900 font-bold text-xl mb-2" ><a class="underline hover:underline-offset-4" href="{{article.getUrlToArticle | default('https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png?20220519031949')}}">{{article.getTitle}}</a></div>
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

<!--    <div class="shadow-lg">-->
<!--        <div class="max-w-sm w-full lg:max-w-full lg:flex">-->
<!--            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/img/card-left.jpg')" title="Woman holding a mug">-->
<!--            </div>-->
<!--            <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">-->
<!--                <div class="mb-8">-->
<!--                    <div class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</div>-->
<!--                    <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>-->
<!--                </div>-->
<!--                <div class="flex items-center">-->
<!--                    <div class="text-sm">-->
<!--                        <p class="text-gray-900 leading-none">Jonathan Reinink</p>-->
<!--                        <p class="text-gray-600">Aug 18</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="shadow-lg">-->
<!--        <div class="max-w-sm w-full lg:max-w-full lg:flex">-->
<!--            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/img/card-left.jpg')" title="Woman holding a mug">-->
<!--            </div>-->
<!--            <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">-->
<!--                <div class="mb-8">-->
<!--                    <div class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</div>-->
<!--                    <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>-->
<!--                </div>-->
<!--                <div class="flex items-center">-->
<!--                    <div class="text-sm">-->
<!--                        <p class="text-gray-900 leading-none">Jonathan Reinink</p>-->
<!--                        <p class="text-gray-600">Aug 18</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="shadow-lg">-->
<!--        <div class="max-w-sm w-full lg:max-w-full lg:flex">-->
<!--            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/img/card-left.jpg')" title="Woman holding a mug">-->
<!--            </div>-->
<!--            <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">-->
<!--                <div class="mb-8">-->
<!--                    <div class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</div>-->
<!--                    <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>-->
<!--                </div>-->
<!--                <div class="flex items-center">-->
<!--                    <div class="text-sm">-->
<!--                        <p class="text-gray-900 leading-none">Jonathan Reinink</p>-->
<!--                        <p class="text-gray-600">Aug 18</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="shadow-lg">-->
<!--        <div class="max-w-sm w-full lg:max-w-full lg:flex">-->
<!--            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/img/card-left.jpg')" title="Woman holding a mug">-->
<!--            </div>-->
<!--            <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">-->
<!--                <div class="mb-8">-->
<!--                    <div class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</div>-->
<!--                    <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>-->
<!--                </div>-->
<!--                <div class="flex items-center">-->
<!--                    <div class="text-sm">-->
<!--                        <p class="text-gray-900 leading-none">Jonathan Reinink</p>-->
<!--                        <p class="text-gray-600">Aug 18</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="shadow-lg">-->
<!--        <div class="max-w-sm w-full lg:max-w-full lg:flex">-->
<!--            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/img/card-left.jpg')" title="Woman holding a mug">-->
<!--            </div>-->
<!--            <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">-->
<!--                <div class="mb-8">-->
<!--                    <div class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</div>-->
<!--                    <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>-->
<!--                </div>-->
<!--                <div class="flex items-center">-->
<!--                    <div class="text-sm">-->
<!--                        <p class="text-gray-900 leading-none">Jonathan Reinink</p>-->
<!--                        <p class="text-gray-600">Aug 18</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="shadow-lg">-->
<!--        <div class="max-w-sm w-full lg:max-w-full lg:flex">-->
<!--            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/img/card-left.jpg')" title="Woman holding a mug">-->
<!--            </div>-->
<!--            <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">-->
<!--                <div class="mb-8">-->
<!--                    <div class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</div>-->
<!--                    <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>-->
<!--                </div>-->
<!--                <div class="flex items-center">-->
<!--                    <div class="text-sm">-->
<!--                        <p class="text-gray-900 leading-none">Jonathan Reinink</p>-->
<!--                        <p class="text-gray-600">Aug 18</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="shadow-lg">-->
<!--        <div class="max-w-sm w-full lg:max-w-full lg:flex">-->
<!--            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/img/card-left.jpg')" title="Woman holding a mug">-->
<!--            </div>-->
<!--            <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">-->
<!--                <div class="mb-8">-->
<!--                    <div class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</div>-->
<!--                    <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>-->
<!--                </div>-->
<!--                <div class="flex items-center">-->
<!--                    <div class="text-sm">-->
<!--                        <p class="text-gray-900 leading-none">Jonathan Reinink</p>-->
<!--                        <p class="text-gray-600">Aug 18</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="shadow-lg">-->
<!--        <div class="max-w-sm w-full lg:max-w-full lg:flex">-->
<!--            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/img/card-left.jpg')" title="Woman holding a mug">-->
<!--            </div>-->
<!--            <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">-->
<!--                <div class="mb-8">-->
<!--                    <div class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</div>-->
<!--                    <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>-->
<!--                </div>-->
<!--                <div class="flex items-center">-->
<!--                    <div class="text-sm">-->
<!--                        <p class="text-gray-900 leading-none">Jonathan Reinink</p>-->
<!--                        <p class="text-gray-600">Aug 18</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>
</body>
</html>