<?php

namespace Database\Seeders;

use App\Models\CarType;
use Illuminate\Database\Seeder;

class CarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carTypes = [
            ["en" => "Acura", "ar" => "أكورا", "ru" => "Акура"],
            ["en" => "Alfa Romeo", "ar" => "ألفا روميو", "ru" => "Альфа Ромео"],
            ["en" => "Audi", "ar" => "أودي", "ru" => "Ауди"],
            ["en" => "BMW", "ar" => "بي إم دبليو", "ru" => "БМВ"],
            ["en" => "Buick", "ar" => "بويك", "ru" => "Бьюик"],
            ["en" => "Cadillac", "ar" => "كاديلاك", "ru" => "Кадиллак"],
            ["en" => "Chevrolet", "ar" => "شيفروليه", "ru" => "Шевроле"],
            ["en" => "Chrysler", "ar" => "كرايسلر", "ru" => "Крайслер"],
            ["en" => "Dodge", "ar" => "دودج", "ru" => "Додж"],
            ["en" => "Fiat", "ar" => "فيات", "ru" => "Фиат"],
            ["en" => "Ford", "ar" => "فورد", "ru" => "Форд"],
            ["en" => "Genesis", "ar" => "جينيسيس", "ru" => "Генезис"],
            ["en" => "GMC", "ar" => "جي إم سي", "ru" => "Джи Эм Си"],
            ["en" => "Honda", "ar" => "هوندا", "ru" => "Хонда"],
            ["en" => "Hyundai", "ar" => "هيونداي", "ru" => "Хёндэ"],
            ["en" => "Infiniti", "ar" => "إنفينيتي", "ru" => "Инфинити"],
            ["en" => "Jaguar", "ar" => "جاجوار", "ru" => "Ягуар"],
            ["en" => "Jeep", "ar" => "جيب", "ru" => "Джип"],
            ["en" => "Kia", "ar" => "كيا", "ru" => "Киа"],
            ["en" => "Land Rover", "ar" => "لاند روفر", "ru" => "Ленд Ровер"],
            ["en" => "Lexus", "ar" => "لكزس", "ru" => "Лексус"],
            ["en" => "Lincoln", "ar" => "لينكولن", "ru" => "Линкольн"],
            ["en" => "Mazda", "ar" => "مازدا", "ru" => "Мазда"],
            ["en" => "McLaren", "ar" => "ماكلارين", "ru" => "Макларен"],
            ["en" => "Mercedes-Benz", "ar" => "مرسيدس-بنز", "ru" => "Мерседес-Бенц"],
            ["en" => "Mini", "ar" => "ميني", "ru" => "Мини"],
            ["en" => "Mitsubishi", "ar" => "ميتسوبيشي", "ru" => "Мицубиси"],
            ["en" => "Nissan", "ar" => "نيسان", "ru" => "Ниссан"],
            ["en" => "Porsche", "ar" => "بورش", "ru" => "Порше"],
            ["en" => "Ram", "ar" => "رام", "ru" => "Рам"],
            ["en" => "Subaru", "ar" => "سوبارو", "ru" => "Субару"],
            ["en" => "Tesla", "ar" => "تسلا", "ru" => "Тесла"],
            ["en" => "Toyota", "ar" => "تويوتا", "ru" => "Тойота"],
            ["en" => "Volkswagen", "ar" => "فولكس فاجن", "ru" => "Фольксваген"],
            ["en" => "Volvo", "ar" => "فولفو", "ru" => "Вольво"],
            ["en" => "Peugeot", "ar" => "بيجو", "ru" => "Пежо"],
            ["en" => "Renault", "ar" => "رينو", "ru" => "Рено"],
            ["en" => "SEAT", "ar" => "سيات", "ru" => "Сеат"],
            ["en" => "Skoda", "ar" => "سكودا", "ru" => "Шкода"],
            ["en" => "Chery", "ar" => "شيري", "ru" => "Чери"],
            ["en" => "Geely", "ar" => "جيلي", "ru" => "Джили"],
            ["en" => "BYD", "ar" => "بي واي دي", "ru" => "БИД"],
            ["en" => "Proton", "ar" => "بروتون", "ru" => "Протон"],
            ["en" => "Mahindra", "ar" => "ماهيندرا", "ru" => "Махиндра"],
            ["en" => "Tata", "ar" => "تاتا", "ru" => "Тата"],
            ["en" => "Dongfeng", "ar" => "دونج فينج", "ru" => "Дунфэн"],
            ["en" => "Changan", "ar" => "شانجان", "ru" => "Чанган"],
            ["en" => "Haval", "ar" => "هافال", "ru" => "Хавейл"],
        ];

        foreach ($carTypes as $type) {
            CarType::create([
                'name_en' => $type['en'],
                'name_ar' => $type['ar'],
                'name_ru' => $type['ru'],
            ]);
        }
    }
}
