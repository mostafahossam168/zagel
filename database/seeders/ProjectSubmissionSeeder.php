<?php

namespace Database\Seeders;

use App\Enums\ProjectSubmissionStatus;
use App\Models\ProjectSubmission;
use Illuminate\Database\Seeder;

class ProjectSubmissionSeeder extends Seeder
{
    public function run(): void
    {
        $submissions = [
            [
                'name'                => 'أحمد محمد السيد',
                'email'               => 'ahmed@example.com',
                'phone'               => '0501234567',
                'project_title'       => 'تطبيق تعليمي للأطفال في مرحلة ما قبل المدرسة',
                'project_description' => 'مشروع تطبيق تفاعلي يساعد الأطفال بين 3-6 سنوات على تعلم القراءة والكتابة والحساب من خلال الألعاب التعليمية المرئية والصوتية.',
                'needs'               => 'نحتاج إلى دعم في التصميم والتطوير وكذلك خبراء في التربية وعلم النفس الطفولي.',
                'status'              => ProjectSubmissionStatus::NEW->value,
                'admin_notes'         => null,
            ],
            [
                'name'                => 'فاطمة عبدالله الزهراني',
                'email'               => 'fatima@example.com',
                'phone'               => '0557654321',
                'project_title'       => 'برنامج دعم الأمهات الجدد',
                'project_description' => 'برنامج متكامل يقدم الدعم النفسي والتثقيف الصحي للأمهات في السنة الأولى من الولادة، يشمل جلسات أونلاين وحقيبة موارد رقمية.',
                'needs'               => 'نحتاج إلى متخصصين في الصحة النفسية وقابلات معتمدات للمحتوى، وكذلك منصة لإدارة الجلسات.',
                'status'              => ProjectSubmissionStatus::REVIEWED->value,
                'admin_notes'         => 'المشروع واعد جداً، تم التواصل مع مقدمة المشروع لمناقشة آلية التعاون.',
            ],
            [
                'name'                => 'خالد عبدالرحمن العتيبي',
                'email'               => 'khalid@example.com',
                'phone'               => '0512345678',
                'project_title'       => 'مبادرة الأب القدوة',
                'project_description' => 'برنامج تدريبي موجه للآباء يعزز دورهم في التربية الأسرية ويبني مهاراتهم في التواصل مع أبنائهم في مختلف المراحل العمرية.',
                'needs'               => 'خبراء في التربية الأسرية، قاعة تدريب، ودعم في التسويق لاستهداف الآباء.',
                'status'              => ProjectSubmissionStatus::ACCEPTED->value,
                'admin_notes'         => 'تم قبول المشروع وإدراجه ضمن برامج منصة زاجل للربع القادم. سيتم التواصل مع صاحب المشروع لتوقيع الاتفاقية.',
            ],
            [
                'name'                => 'نورة سعد القحطاني',
                'email'               => 'noura@example.com',
                'phone'               => null,
                'project_title'       => 'سوق الأسرة الرقمي',
                'project_description' => 'منصة للبيع والشراء بين الأسر تشمل الملابس والأثاث والمستلزمات الأسرية المستعملة بحالة جيدة، مع نظام تقييم للبائعين.',
                'needs'               => 'فريق تطوير وخادم استضافة وفريق دعم عملاء.',
                'status'              => ProjectSubmissionStatus::REJECTED->value,
                'admin_notes'         => 'المشروع لا يتوافق مع توجه المنصة المتخصص في الخدمات التعليمية والأسرية. يُنصح بالتواصل مع منصات التجارة الإلكترونية المتخصصة.',
            ],
            [
                'name'                => 'محمد يوسف الدوسري',
                'email'               => 'mohammed@example.com',
                'phone'               => '0531122334',
                'project_title'       => 'أكاديمية الجدود والأحفاد',
                'project_description' => 'برنامج يربط بين كبار السن وأحفادهم من خلال ورش يدوية وحرفية، يهدف إلى نقل المهارات التراثية وتعزيز الترابط الأسري بين الأجيال.',
                'needs'               => 'مواقع لإقامة الورش في عدة مدن، وتمويل لمواد الحرف اليدوية، ومصور لتوثيق الجلسات.',
                'status'              => ProjectSubmissionStatus::NEW->value,
                'admin_notes'         => null,
            ],
        ];

        foreach ($submissions as $submission) {
            ProjectSubmission::create($submission);
        }
    }
}
