<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // The data that was previously in your controller
        $careers = [
            [
                'title' => 'Talent Acquisition Specialist',
                'description' => 'SynFlow AI is seeking a full-time, remote Talent Acquisition Specialist to help us find, attract, and onboard top talent across our technical, consulting, education, and operations teams. We’re growing rapidly and need a proactive recruiter who can source, screen, and coordinate high-quality candidates with precision and speed.',
                'responsibilities' => [
                    'Collaborate with leadership to understand hiring needs and role requirements.',
                    'Source and engage candidates on platforms like LinkedIn, job boards, and professional communities.',
                    'Manage applications, screen candidates, and move top profiles through the pipeline.',
                    'Conduct initial screening calls to assess candidate fit.',
                    'Coordinate subsequent interviews with hiring managers.',
                    'Publish and maintain job posts across various hiring platforms.',
                    'Proactively outreach to and engage with candidates who are a match for our talent and culture.',
                    'Maintain organized tracking of candidates and hiring statuses.',
                    'Suggest improvements to our hiring processes and candidate experience.',
                ],
                'requirements' => [
                    'A minimum of 2 years of experience in recruitment, sourcing, or talent acquisition.',
                    'Proven success in filling technical, consulting, or business roles in fast-paced environments.',
                    'Strong communication skills for engaging with candidates and internal teams.',
                    'A self-starter with the ability to work independently and meet deadlines.',
                    'Comfortable with remote, asynchronous work.',
                    'Familiarity with applicant tracking systems and management tools.',
                ],
                'desirable' => [
                    'Experience recruiting for startups, tech, AI, or education companies.',
                    'Ability to assess candidates for both skills and cultural fit.',
                    'Familiarity with AI tools and automation platforms.',
                    'Experience with global talent sourcing and remote hiring best practices.',
                ],
                'we_offer' => [
                    'A remote working structure with flexibility over your schedule.',
                    'A competitive salary based on experience.',
                    'Exposure to hiring across cutting-edge AI, consulting, and educational projects.',
                    'A fast-moving, supportive team environment focused on execution and growth.',
                ],
            ],
            [
                'title' => 'Graphic Designer',
                'description' => 'A dynamic and creative designer to join our team...',
                'responsibilities' => ['Create visual assets', 'Collaborate with marketing', 'Develop brand identity'],
                'requirements' => ['2+ years of design experience', 'Proficiency in Adobe Creative Suite'],
                'desirable' => ['Experience with UI/UX design'],
                'we_offer' => ['Flexible hours', 'Competitive salary', 'Creative work environment'],
            ],
            [
                'title' => 'Fullstack Developer',
                'description' => 'We are seeking a talented Fullstack Developer to join our team. You will be responsible for building and maintaining both the front-end and back-end of our web applications.',
                'responsibilities' => ['Develop and maintain web applications', 'Write clean and efficient code', 'Collaborate with team members'],
                'requirements' => ['3+ years of experience with web development', 'Proficiency in JavaScript, Python, and a web framework like Laravel or Django'],
                'desirable' => ['Experience with cloud services (AWS, GCP)'],
                'we_offer' => ['Competitive salary', 'Flexible work environment', 'Opportunity to work on exciting projects'],
            ],
            [
                'title' => 'Machine Learning Engineer',
                'description' => 'SynFlow AI is looking for a Machine Learning Engineer to design and develop ML systems. You will work on cutting-edge AI models.',
                'responsibilities' => ['Design and build machine learning models', 'Run ML experiments', 'Collaborate with data scientists'],
                'requirements' => ['2+ years of experience with machine learning', 'Proficiency in Python and ML libraries like TensorFlow or PyTorch'],
                'desirable' => ['Experience with large-scale data processing'],
                'we_offer' => ['Exposure to latest AI technologies', 'Fast-paced and innovative environment', 'Competitive salary'],
            ],
            [
                'title' => 'Video Editor - Youtube Vlogs',
                'description' => 'We are looking for a creative Video Editor to produce engaging content for our YouTube channel. You will be responsible for all stages of video post-production.',
                'responsibilities' => ['Edit and assemble video footage', 'Add visual effects and sound effects', 'Work with content creators'],
                'requirements' => ['Proven experience in video editing', 'Proficiency in video editing software (e.g., Adobe Premiere Pro, Final Cut Pro)'],
                'desirable' => ['Experience with YouTube content creation'],
                'we_offer' => ['Flexible hours', 'Creative freedom', 'Competitive salary'],
            ],
            [
                'title' => 'AI Course Instructor (Remote)',
                'description' => 'A passionate AI expert to instruct students in our online courses. You will be responsible for teaching and creating course materials.',
                'responsibilities' => ['Conduct live online classes', 'Develop and update course materials', 'Provide feedback to students'],
                'requirements' => ['Extensive knowledge of AI and machine learning', 'Proven teaching or public speaking experience'],
                'desirable' => ['Experience with online course platforms'],
                'we_offer' => ['Remote work', 'Opportunity to shape the next generation of AI professionals', 'Competitive compensation'],
            ],
            [
                'title' => 'Chief Technology Officer (CTO)',
                'description' => 'We are seeking an experienced CTO to lead our technology and engineering teams. This is a leadership role responsible for driving our technical vision.',
                'responsibilities' => ['Lead and mentor engineering teams', 'Define and execute our technology strategy', 'Manage R&D and innovation'],
                'requirements' => ['10+ years of experience in software development', 'Proven leadership experience in a tech company'],
                'desirable' => ['Experience with strategic planning'],
                'we_offer' => ['Executive-level compensation', 'Opportunity to shape the company\'s future', 'Ownership of technical strategy'],
            ],
            [
                'title' => 'Sales Representative',
                'description' => 'A motivated Sales Representative to drive growth and build client relationships. You will be responsible for generating leads and closing deals.',
                'responsibilities' => ['Identify and qualify sales leads', 'Conduct sales presentations', 'Manage client accounts'],
                'requirements' => ['2+ years of sales experience', 'Strong communication and negotiation skills'],
                'desirable' => ['Experience in B2B tech sales'],
                'we_offer' => ['Performance-based bonuses', 'Opportunity for career growth', 'Supportive team environment'],
            ],
            [
                'title' => 'General Application',
                'description' => 'Tell us about yourself and why you want to work with us!',
                'responsibilities' => [],
                'requirements' => [],
                'desirable' => [],
                'we_offer' => [],
            ],
        ];

        foreach ($careers as $careerData) {
            $slug = ($careerData['title'] === 'General Application') ? 'none-but-i-am-interested-in-working-with-synflow-ai' : Str::slug($careerData['title']);

            Career::create(array_merge($careerData, ['slug' => $slug]));
        }
    }
}
