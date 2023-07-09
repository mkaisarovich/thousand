<?php

namespace App\Http\Traits;

class Utils
{
    public static int $SUCCESS_CODE = 200;

    public static string $MESSAGE_ADD_NEWS = "Новость успешно добавился";
    public static string $MESSAGE_GET_NEWS = "Все новости";
    public static string $MESSAGE_GET_AUTHORS = "Все авторы";
    public static string $MESSAGE_ADD_AUTHOR = "Автор успешно добавился";
    public static string $MESSAGE_ADD_RUBRIC = "Рубрик успешно создался";
    public static string $MESSAGE_GET_RUBRICS = "Все рубрики";
    public static string $MESSAGE_GET_NEWS_INFO = "Информация о статьях";
    public static string $MESSAGE_GET_NEWS_BY_AUTHOR = "Выдача всех новостей конкретного автора";
    public static string $MESSAGE_GET_NEWS_BY_RUBRIC = "выдача списка всех новостей, которые относятся к указанной рубрике";
    public static string $MESSAGE_GET_NEWS_BY_SEARCH = "поиск новости по названию";
    public static string $MESSAGE_GET_RUBRIC_BY_SEARCH = "искать новости по рубрике";
   
}