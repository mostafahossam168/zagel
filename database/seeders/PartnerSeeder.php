<?php

namespace Database\Seeders;

use App\Enums\PartnerStatus;
use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'name'        => 'وزارة التعليم',
                'description' => 'شراكة استراتيجية مع وزارة التعليم لدعم البرامج التعليمية الأسرية وتطوير المناهج التربوية.',
                'image'       => null,
                'status'      => PartnerStatus::PUBLISHED->value,
            ],
            [
                'name'        => 'جمعية الأسرة السعودية',
                'description' => 'تعاون مشترك لتقديم برامج التوعية الأسرية وورش العمل في مختلف مناطق المملكة.',
                'image'       => null,
                'status'      => PartnerStatus::PUBLISHED->value,
            ],
            [
                'name'        => 'مركز الملك عبدالعزيز للحوار الوطني',
                'description' => 'شراكة في مجال تنمية الوعي الاجتماعي وتعزيز قيم الحوار داخل الأسرة.',
                'image'       => null,
                'status'      => PartnerStatus::PUBLISHED->value,
            ],
            [
                'name'        => 'مؤسسة الوليد للإنسانية',
                'description' => 'دعم البرامج الأسرية الموجهة للأسر محدودة الدخل وتمكين المرأة.',
                'image'       => null,
                'status'      => PartnerStatus::PUBLISHED->value,
            ],
            [
                'name'        => 'أكاديمية التطوير الأسري',
                'description' => 'شريك تدريبي متخصص في تأهيل المرشدين والمدربين الأسريين.',
                'image'       => null,
                'status'      => PartnerStatus::DRAFT->value,
            ],
            [
                'name'        => 'شبكة المرشدين التربويين',
                'description' => 'شبكة وطنية من المرشدين والمتخصصين في التربية وعلم النفس الأسري.',
                'image'       => null,
                'status'      => PartnerStatus::DRAFT->value,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
