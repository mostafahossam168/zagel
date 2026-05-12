<?php

namespace Database\Seeders;

use App\Enums\ServiceStatus;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title_ar'       => 'برنامج التواصل الأسري الفعّال',
                'title_en'       => 'Effective Family Communication Program',
                'description_ar' => 'برنامج تدريبي متكامل يهدف إلى تعزيز مهارات الحوار والاستماع بين أفراد الأسرة، ويشمل 8 جلسات تفاعلية مع مدرب معتمد.',
                'description_en' => 'A comprehensive training program aimed at enhancing dialogue and listening skills among family members.',
                'category_id'    => 1,
                'price'          => 350.00,
                'is_purchasable' => true,
                'sort_order'     => 1,
                'status'         => ServiceStatus::ACTIVE->value,
                'image'          => null,
            ],
            [
                'title_ar'       => 'حقيبة تربية الطفل (0-6 سنوات)',
                'title_en'       => 'Child Parenting Kit (0-6 Years)',
                'description_ar' => 'حقيبة تدريبية شاملة للوالدين تحتوي على دليل تربوي + فيديوهات تعليمية + أوراق عمل تفاعلية لمراحل النمو الأولى.',
                'description_en' => 'A comprehensive training kit for parents covering early childhood development stages.',
                'category_id'    => 1,
                'price'          => 199.00,
                'is_purchasable' => true,
                'sort_order'     => 2,
                'status'         => ServiceStatus::ACTIVE->value,
                'image'          => null,
            ],
            [
                'title_ar'       => 'استشارة أسرية فردية',
                'title_en'       => 'Individual Family Consultation',
                'description_ar' => 'جلسة استشارية خاصة مع أحد متخصصينا المعتمدين في الإرشاد الأسري لمدة 60 دقيقة عبر الإنترنت أو حضورياً.',
                'description_en' => 'A private consultation session with one of our certified family counselors.',
                'category_id'    => null,
                'price'          => 250.00,
                'is_purchasable' => true,
                'sort_order'     => 3,
                'status'         => ServiceStatus::ACTIVE->value,
                'image'          => null,
            ],
            [
                'title_ar'       => 'ورشة الأب في حياة أبنائه',
                'title_en'       => 'Father\'s Role Workshop',
                'description_ar' => 'ورشة عمل ميدانية تُعقد مرة شهرياً، تُعنى بتفعيل دور الأب في التربية والتواصل العاطفي مع الأبناء في مختلف المراحل.',
                'description_en' => 'A monthly hands-on workshop focusing on the father\'s active role in raising children.',
                'category_id'    => 1,
                'price'          => null,
                'is_purchasable' => false,
                'sort_order'     => 4,
                'status'         => ServiceStatus::ACTIVE->value,
                'image'          => null,
            ],
            [
                'title_ar'       => 'برنامج المراهق والأسرة',
                'title_en'       => 'Teen & Family Program',
                'description_ar' => 'برنامج متخصص في التعامل مع مرحلة المراهقة، يُقدَّم للوالدين والمراهقين معاً من خلال جلسات مشتركة وفردية.',
                'description_en' => 'A specialized program for dealing with adolescence, offered to both parents and teens.',
                'category_id'    => 1,
                'price'          => 420.00,
                'is_purchasable' => true,
                'sort_order'     => 5,
                'status'         => ServiceStatus::ACTIVE->value,
                'image'          => null,
            ],
            [
                'title_ar'       => 'دليل الأسرة المتوازنة',
                'title_en'       => 'Balanced Family Guide',
                'description_ar' => 'دليل رقمي شامل يحتوي على أكثر من 100 صفحة من الإرشادات التربوية والنفسية مُنظَّمة حسب أعمار الأطفال ومراحل الزواج.',
                'description_en' => 'A comprehensive digital guide with over 100 pages of educational and psychological guidance.',
                'category_id'    => null,
                'price'          => 79.00,
                'is_purchasable' => true,
                'sort_order'     => 6,
                'status'         => ServiceStatus::INACTIVE->value,
                'image'          => null,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
