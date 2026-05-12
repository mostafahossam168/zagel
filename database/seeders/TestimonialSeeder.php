<?php

namespace Database\Seeders;

use App\Enums\TestimonialStatus;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name'     => 'أم عبدالله الغامدي',
                'company'  => 'ربة منزل',
                'position' => 'أم لثلاثة أطفال',
                'content'  => 'اشتركت في برنامج التواصل الأسري وكان له أثر كبير في تحسين علاقتي مع أبنائي. تعلمت كيف أستمع إليهم بشكل صحيح وأعبّر عن مشاعري بطريقة بنّاءة. أنصح كل أم به بشدة.',
                'rating'   => 5,
                'status'   => TestimonialStatus::ACTIVE->value,
                'image'    => null,
            ],
            [
                'name'     => 'د. سعد العمري',
                'company'  => 'جامعة الملك سعود',
                'position' => 'أستاذ مشارك - قسم علم النفس',
                'content'  => 'منصة زاجل تُقدم خدمات راقية المستوى يندر وجودها في السوق السعودي. المحتوى العلمي دقيق وموثّق، والمدربون على درجة عالية من الكفاءة. أوصي بها لطلابي وعائلاتهم.',
                'rating'   => 5,
                'status'   => TestimonialStatus::ACTIVE->value,
                'image'    => null,
            ],
            [
                'name'     => 'محمد الشهري',
                'company'  => 'شركة أرامكو السعودية',
                'position' => 'مهندس',
                'content'  => 'حضرت ورشة "الأب في حياة أبنائه" وخرجت منها بنظرة مختلفة تماماً لدوري كأب. الجلسات عملية ومبنية على واقع الأسرة السعودية، لا مجرد نظريات مستوردة.',
                'rating'   => 5,
                'status'   => TestimonialStatus::ACTIVE->value,
                'image'    => null,
            ],
            [
                'name'     => 'ريم الحربي',
                'company'  => 'معلمة',
                'position' => 'معلمة مدرسة ابتدائية',
                'content'  => 'استفدت كثيراً من حقيبة تربية الطفل في عملي وفي تربية ابنتي. الأدوات التطبيقية والأوراق التفاعلية مميزة جداً. لكن كنت أتمنى أن يكون هناك دعم أطول بعد انتهاء البرنامج.',
                'rating'   => 4,
                'status'   => TestimonialStatus::ACTIVE->value,
                'image'    => null,
            ],
            [
                'name'     => 'خالد المطيري',
                'company'  => 'رجل أعمال',
                'position' => null,
                'content'  => 'جربت الاستشارة الأسرية الفردية وكانت تجربة محترمة، المستشار كان متفهماً ومحترفاً. البرنامج يستحق أكثر من تقييم 4 نجوم لكنني لا أزال في بداية التطبيق.',
                'rating'   => 4,
                'status'   => TestimonialStatus::INACTIVE->value,
                'image'    => null,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
