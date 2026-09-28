<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\CourseStage;
use App\Models\Episode;
use App\Models\LessonBlock;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorporateResponsibleAICourseSeeder extends Seeder
{
    public const COURSE_ID = 2;

    public const COURSE_TITLE =
        'Corporate AI Ethics, Governance & Responsible AI in the Workplace';

    public function run(): void
    {
        DB::transaction(function () {
            $course = Course::find(self::COURSE_ID);

            if (!$course) {
                $course = new Course();
                $course->id = self::COURSE_ID;
            }

            $course->fill([
                'title' => self::COURSE_TITLE,
                'description' =>
                    'From AI Awareness to Responsible Use, Governance & Implementation. '
                    . 'A corporate and institutional professional program covering responsible AI, '
                    . 'privacy, cybersecurity, AI governance, risk management and practical implementation.',
                'image_url' => null,
            ]);

            $course->save();

            $stages = [
                [
                    'slug' => 'ai-foundations',
                    'title' => 'AI & Responsible AI Foundations',
                    'description' => 'Understand AI, ethics, privacy, accuracy, fairness and human accountability.',
                    'position' => 1,
                ],
                [
                    'slug' => 'responsible-workplace-ai',
                    'title' => 'Responsible Workplace AI',
                    'description' => 'Apply responsible AI principles to everyday workplace use.',
                    'position' => 2,
                ],
                [
                    'slug' => 'ai-systems-and-risk',
                    'title' => 'AI Systems, Agents & Third-Party Risk',
                    'description' => 'Understand AI agents, procurement, vendors and organizational AI risk.',
                    'position' => 3,
                ],
                [
                    'slug' => 'ai-governance',
                    'title' => 'AI Risk & Governance',
                    'description' => 'Build governance, lifecycle, monitoring, documentation and incident-management capability.',
                    'position' => 4,
                ],
                [
                    'slug' => 'leadership-and-culture',
                    'title' => 'Leadership & Responsible AI Culture',
                    'description' => 'Establish organizational accountability, policy and responsible AI culture.',
                    'position' => 5,
                ],
                [
                    'slug' => 'implementation',
                    'title' => 'Corporate AI Implementation Workshop',
                    'description' => 'Turn responsible AI knowledge into an organizational implementation pack and action plan.',
                    'position' => 6,
                ],
            ];

            $stageModels = [];

            foreach ($stages as $stageData) {
                $stageModels[$stageData['slug']] = CourseStage::updateOrCreate(
                    [
                        'course_id' => $course->id,
                        'slug' => $stageData['slug'],
                    ],
                    $stageData
                );
            }

            /*
             * The curriculum below is derived from the supplied
             * Corporate AI Ethics, Governance & Responsible AI
             * curriculum.
             */
            $modules = [

                // ---------------------------------------------------------
                // STAGE 1
                // ---------------------------------------------------------

                [
                    'stage' => 'ai-foundations',
                    'position' => 1,
                    'title' => 'AI in the Modern Workplace',
                    'description' => 'Understand artificial intelligence and how organizations use AI in everyday work.',
                    'content' => [
                        'What is Artificial Intelligence?',
                        'AI systems can perform tasks associated with human cognitive abilities such as recognizing patterns, understanding language, generating content, making predictions and assisting decisions.',
                        'Common workplace applications include generative AI, AI assistants, customer-service chatbots, recommendation systems, predictive analytics, fraud detection, recruitment tools, workflow automation, AI agents, meeting assistants and document analysis.',
                        'Exercise: Identify every AI application currently being used or considered within your organization.',
                        'Key principle: AI can support human capability, but responsibility for organizational decisions cannot simply be delegated to an AI system.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which statement best describes AI in the workplace?',
                            'options' => [
                                'AI can support people with cognitive and analytical tasks',
                                'AI removes all employee responsibility',
                                'AI is only used by software developers',
                                'AI can only generate images',
                            ],
                            'correct_answer' => 'AI can support people with cognitive and analytical tasks',
                        ],
                        [
                            'question' => 'Which is an example of workplace AI?',
                            'options' => [
                                'AI-assisted document analysis',
                                'A physical filing cabinet',
                                'A paper notebook',
                                'A manual stapler',
                            ],
                            'correct_answer' => 'AI-assisted document analysis',
                        ],
                        [
                            'question' => 'Who remains responsible for organizational decisions involving AI?',
                            'options' => [
                                'The organization and responsible people',
                                'The AI system alone',
                                'The software vendor alone',
                                'Nobody',
                            ],
                            'correct_answer' => 'The organization and responsible people',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-foundations',
                    'position' => 2,
                    'title' => 'Foundations of AI Ethics',
                    'description' => 'Understand the principles that guide responsible AI use.',
                    'content' => [
                        'Responsible AI is built around fairness, accountability, transparency, privacy, security, reliability, human oversight and inclusiveness.',
                        'Fairness means AI should not unjustifiably disadvantage people or groups.',
                        'Accountability means people and organizations remain responsible for how AI systems are used.',
                        'Transparency means significant AI use should be communicated appropriately.',
                        'Privacy and security require appropriate protection of people and organizational information.',
                        'Human oversight means humans retain meaningful oversight where consequences warrant it.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which principle requires organizations to remain responsible for AI use?',
                            'options' => ['Accountability', 'Automation', 'Speed', 'Marketing'],
                            'correct_answer' => 'Accountability',
                        ],
                        [
                            'question' => 'Which principle concerns protecting personal information?',
                            'options' => ['Privacy', 'Advertising', 'Automation', 'Revenue'],
                            'correct_answer' => 'Privacy',
                        ],
                        [
                            'question' => 'What does meaningful human oversight provide?',
                            'options' => [
                                'Human review where consequences warrant it',
                                'Automatic approval of every AI output',
                                'Removal of human responsibility',
                                'Unlimited AI authority',
                            ],
                            'correct_answer' => 'Human review where consequences warrant it',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-foundations',
                    'position' => 3,
                    'title' => 'Privacy, Confidentiality & Data Protection',
                    'description' => 'Learn how inappropriate AI use can expose sensitive organizational information.',
                    'content' => [
                        'Information requiring particular protection includes customer information, employee records, financial information, passwords, authentication credentials, contracts, health information, identification documents, internal reports, proprietary information, trade secrets and unreleased strategies.',
                        'MOOSE LOON DATA SAFETY METHOD:',
                        'STOP → CLASSIFY → CHECK → MINIMIZE → USE',
                        'STOP: Do not automatically paste organizational information into AI.',
                        'CLASSIFY: Determine information sensitivity.',
                        'CHECK: Confirm whether the AI tool and intended use are approved.',
                        'MINIMIZE: Share only information required for the legitimate task.',
                        'USE: Proceed only under applicable organizational requirements.',
                        'Practical scenario: An HR employee wants AI to rewrite a confidential disciplinary report.',
                    ],
                    'questions' => [
                        [
                            'question' => 'What should happen first before putting sensitive company information into AI?',
                            'options' => ['Stop and assess it', 'Upload everything', 'Publish it', 'Ignore the information'],
                            'correct_answer' => 'Stop and assess it',
                        ],
                        [
                            'question' => 'What does MINIMIZE mean in the data safety method?',
                            'options' => [
                                'Share only information required for the legitimate task',
                                'Share all available information',
                                'Delete company records',
                                'Disable security controls',
                            ],
                            'correct_answer' => 'Share only information required for the legitimate task',
                        ],
                        [
                            'question' => 'Which information requires particular protection?',
                            'options' => [
                                'Customer and employee information',
                                'Public weather information',
                                'Public office opening hours',
                                'Generic dictionary definitions',
                            ],
                            'correct_answer' => 'Customer and employee information',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-foundations',
                    'position' => 4,
                    'title' => 'AI Hallucinations, Accuracy & Misinformation',
                    'description' => 'Recognize incorrect or unsupported AI output and verify consequential information.',
                    'content' => [
                        'Generative AI can confidently produce incorrect or unsupported information.',
                        'Participants learn to identify invented facts, false references, incorrect calculations, misinterpreted information, unsupported conclusions, outdated information and fabricated quotations.',
                        'Verification principle: Generate with AI where appropriate. Verify before relying on consequential output.',
                        'Practical exercise: Verify an AI-generated corporate report.',
                    ],
                    'questions' => [
                        [
                            'question' => 'What is an AI hallucination?',
                            'options' => [
                                'Incorrect or unsupported information presented as reliable',
                                'A successful backup',
                                'A cybersecurity firewall',
                                'A verified company report',
                            ],
                            'correct_answer' => 'Incorrect or unsupported information presented as reliable',
                        ],
                        [
                            'question' => 'What should employees do before relying on consequential AI output?',
                            'options' => ['Verify it', 'Publish it immediately', 'Ignore the output', 'Delete the source'],
                            'correct_answer' => 'Verify it',
                        ],
                        [
                            'question' => 'Which is an example of unreliable AI output?',
                            'options' => ['A fabricated quotation', 'A verified document', 'An approved policy', 'A confirmed transaction'],
                            'correct_answer' => 'A fabricated quotation',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-foundations',
                    'position' => 5,
                    'title' => 'AI Bias, Fairness & Discrimination',
                    'description' => 'Understand how AI bias can affect workplace and organizational decisions.',
                    'content' => [
                        'AI bias can arise through training data, historical patterns, system design, proxy variables, inappropriate deployment and human interpretation.',
                        'Potentially affected areas include recruitment, promotions, performance management, lending, insurance, customer profiling, education and access to services.',
                        'Key principle: Automated does not automatically mean objective or fair.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which can contribute to AI bias?',
                            'options' => ['Historical patterns in data', 'Only hardware', 'Office furniture', 'Internet speed'],
                            'correct_answer' => 'Historical patterns in data',
                        ],
                        [
                            'question' => 'Does automation automatically guarantee fairness?',
                            'options' => ['No', 'Yes', 'Only for HR', 'Only for finance'],
                            'correct_answer' => 'No',
                        ],
                        [
                            'question' => 'Which area can be affected by AI bias?',
                            'options' => ['Recruitment', 'Office cleaning', 'Printer maintenance', 'Building security only'],
                            'correct_answer' => 'Recruitment',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-foundations',
                    'position' => 6,
                    'title' => 'Human Oversight & Accountability',
                    'description' => 'Understand when AI should assist rather than determine consequential decisions.',
                    'content' => [
                        'Special attention is required for decisions involving employment, finance, healthcare, education, safety, legal rights, essential services and disciplinary action.',
                        'HUMAN-IN-THE-LOOP MODEL:',
                        'AI Assists → Human Reviews → Human Decides → Organization Remains Accountable',
                        'Human review must be meaningful rather than automatic approval of AI recommendations.',
                    ],
                    'questions' => [
                        [
                            'question' => 'What is the human-in-the-loop model?',
                            'options' => [
                                'AI assists, a human reviews and decides, and the organization remains accountable',
                                'AI makes every decision',
                                'Humans approve every AI output automatically',
                                'No one reviews AI decisions',
                            ],
                            'correct_answer' => 'AI assists, a human reviews and decides, and the organization remains accountable',
                        ],
                        [
                            'question' => 'Which decision may require strong human oversight?',
                            'options' => ['Employment', 'Choosing a font', 'Formatting a document', 'Creating a shopping list'],
                            'correct_answer' => 'Employment',
                        ],
                        [
                            'question' => 'What should human review be?',
                            'options' => ['Meaningful', 'Automatic', 'Symbolic', 'Absent'],
                            'correct_answer' => 'Meaningful',
                        ],
                    ],
                ],

                // ---------------------------------------------------------
                // STAGE 2
                // ---------------------------------------------------------

                [
                    'stage' => 'responsible-workplace-ai',
                    'position' => 7,
                    'title' => 'Responsible Generative AI',
                    'description' => 'Apply responsible practices when using generative AI for workplace tasks.',
                    'content' => [
                        'Generative AI can assist with emails, reports, presentations, research, images, marketing materials, customer communications, policies, software code and business analysis.',
                        'Before publishing or acting, ask: Is it accurate? Is it appropriate? Is the information protected? Could someone be unfairly affected? Does it require human review? Are there intellectual-property concerns? Does AI involvement need to be disclosed?',
                    ],
                    'questions' => [
                        [
                            'question' => 'What should happen before acting on important AI-generated content?',
                            'options' => ['Review and verify it', 'Publish immediately', 'Assume it is correct', 'Remove all human involvement'],
                            'correct_answer' => 'Review and verify it',
                        ],
                        [
                            'question' => 'Which is a responsible AI question?',
                            'options' => ['Is the information protected?', 'Can I avoid all review?', 'Can I hide AI involvement?', 'Can I upload everything?'],
                            'correct_answer' => 'Is the information protected?',
                        ],
                        [
                            'question' => 'Can generative AI be used to draft business analysis?',
                            'options' => ['Yes, with appropriate controls and review', 'Never', 'Only by developers', 'Only without human review'],
                            'correct_answer' => 'Yes, with appropriate controls and review',
                        ],
                    ],
                ],

                [
                    'stage' => 'responsible-workplace-ai',
                    'position' => 8,
                    'title' => 'Intellectual Property & AI',
                    'description' => 'Recognize intellectual-property issues associated with AI-generated and third-party content.',
                    'content' => [
                        'Topics include copyright, trademarks, licensing, proprietary information, AI-generated code, third-party content, commercial reuse and ownership questions.',
                        'Employees should not assume AI-generated content is automatically free of intellectual-property concerns.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which area can create an intellectual-property concern?',
                            'options' => ['Copyright', 'Office temperature', 'Meeting duration', 'Printer speed'],
                            'correct_answer' => 'Copyright',
                        ],
                        [
                            'question' => 'Should employees assume AI-generated content is automatically free of IP concerns?',
                            'options' => ['No', 'Yes', 'Always', 'Only for images'],
                            'correct_answer' => 'No',
                        ],
                        [
                            'question' => 'Which is relevant when using third-party AI content commercially?',
                            'options' => ['Licensing and ownership', 'Desk location', 'Office lighting', 'Employee parking'],
                            'correct_answer' => 'Licensing and ownership',
                        ],
                    ],
                ],

                [
                    'stage' => 'responsible-workplace-ai',
                    'position' => 9,
                    'title' => 'AI Cybersecurity, Deepfakes & Fraud',
                    'description' => 'Recognize AI-enabled phishing, impersonation and fraud.',
                    'content' => [
                        'Participants learn to recognize AI phishing, deepfake video, voice cloning, executive impersonation, fake invoices, social engineering, synthetic identities and AI-assisted fraud.',
                        'CEO Voice Scenario: An employee receives an urgent voice message apparently from the CEO requesting a financial transfer.',
                        'Security principle: Verify identity through trusted procedures, not simply voice, video, writing style or apparent urgency.',
                    ],
                    'questions' => [
                        [
                            'question' => 'What should an employee do with an urgent voice payment request from an apparent executive?',
                            'options' => [
                                'Verify through an independently trusted channel',
                                'Immediately transfer the money',
                                'Trust the voice automatically',
                                'Ignore all financial controls',
                            ],
                            'correct_answer' => 'Verify through an independently trusted channel',
                        ],
                        [
                            'question' => 'Which is an AI-enabled fraud risk?',
                            'options' => ['Voice cloning', 'Paper filing', 'Office cleaning', 'Manual printing'],
                            'correct_answer' => 'Voice cloning',
                        ],
                        [
                            'question' => 'Does a convincing voice prove identity?',
                            'options' => ['No', 'Yes', 'Always', 'Only for executives'],
                            'correct_answer' => 'No',
                        ],
                    ],
                ],

                [
                    'stage' => 'responsible-workplace-ai',
                    'position' => 10,
                    'title' => 'Shadow AI',
                    'description' => 'Identify and control unauthorized AI use inside organizations.',
                    'content' => [
                        'Shadow AI occurs when employees use AI systems without organizational authorization or oversight.',
                        'Examples include personal AI accounts, unapproved chatbots, browser extensions, meeting transcription applications, AI writing assistants and unapproved automation platforms.',
                        'Organizations should establish an approved tools list, restricted tools list, prohibited uses, data rules and approval procedures.',
                    ],
                    'questions' => [
                        [
                            'question' => 'What is Shadow AI?',
                            'options' => [
                                'AI used without organizational authorization or oversight',
                                'Approved enterprise AI',
                                'An AI backup system',
                                'A cybersecurity standard',
                            ],
                            'correct_answer' => 'AI used without organizational authorization or oversight',
                        ],
                        [
                            'question' => 'Which can be Shadow AI?',
                            'options' => ['A personal AI account used for company work without approval', 'An approved corporate tool', 'An approved database', 'An approved CRM'],
                            'correct_answer' => 'A personal AI account used for company work without approval',
                        ],
                        [
                            'question' => 'What should organizations establish?',
                            'options' => ['Approved and restricted tool rules', 'No AI rules', 'Unlimited AI access', 'Only personal accounts'],
                            'correct_answer' => 'Approved and restricted tool rules',
                        ],
                    ],
                ],

                [
                    'stage' => 'responsible-workplace-ai',
                    'position' => 11,
                    'title' => 'Responsible AI in HR & Recruitment',
                    'description' => 'Apply responsible AI principles to recruitment and employee management.',
                    'content' => [
                        'Topics include CV screening, candidate ranking, interview assistance, performance evaluation, promotion decisions, workforce planning, employee monitoring and productivity analytics.',
                        'HR should consider fairness, privacy, transparency, accuracy, human oversight and documentation.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which HR activity can involve AI?',
                            'options' => ['CV screening', 'Only payroll printing', 'Office cleaning', 'Building maintenance'],
                            'correct_answer' => 'CV screening',
                        ],
                        [
                            'question' => 'Which principle is important when using AI in recruitment?',
                            'options' => ['Fairness', 'Secrecy from everyone', 'No review', 'Unlimited automation'],
                            'correct_answer' => 'Fairness',
                        ],
                        [
                            'question' => 'Should AI alone make consequential employment decisions?',
                            'options' => ['Human oversight should be maintained', 'Yes', 'Always', 'Without documentation'],
                            'correct_answer' => 'Human oversight should be maintained',
                        ],
                    ],
                ],

                [
                    'stage' => 'responsible-workplace-ai',
                    'position' => 12,
                    'title' => 'Employee Monitoring & Workplace Surveillance',
                    'description' => 'Examine responsible use of AI for workplace monitoring.',
                    'content' => [
                        'Organizations may use AI to analyze productivity, attendance, communications, computer activity, location, performance, video or biometric information.',
                        'Participants explore proportionality, transparency, privacy, fairness and applicable workplace requirements.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which can be analyzed by workplace AI monitoring?',
                            'options' => ['Productivity and attendance', 'Only office furniture', 'Only public news', 'Only weather'],
                            'correct_answer' => 'Productivity and attendance',
                        ],
                        [
                            'question' => 'What should organizations consider when monitoring employees?',
                            'options' => ['Proportionality, transparency, privacy and fairness', 'Only cost', 'Only speed', 'Nothing'],
                            'correct_answer' => 'Proportionality, transparency, privacy and fairness',
                        ],
                        [
                            'question' => 'Why does transparency matter in workplace surveillance?',
                            'options' => ['Employees may be affected by the monitoring', 'It increases internet speed', 'It removes all risks', 'It makes AI perfect'],
                            'correct_answer' => 'Employees may be affected by the monitoring',
                        ],
                    ],
                ],

                // ---------------------------------------------------------
                // STAGE 3
                // ---------------------------------------------------------

                [
                    'stage' => 'ai-systems-and-risk',
                    'position' => 13,
                    'title' => 'AI Agents & Autonomous Systems',
                    'description' => 'Understand the risks created when AI systems can take actions.',
                    'content' => [
                        'AI agents may send emails, access databases, create records, trigger workflows, communicate with customers, generate documents and execute approved business actions.',
                        'Organizations should consider permission boundaries, least-privilege access, human approval points, logging, monitoring, spending or transaction limits, escalation procedures and emergency shutdown procedures.',
                        'Principle: The more authority an AI system receives, the stronger its controls should become.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Why do AI agents require stronger controls as their authority increases?',
                            'options' => [
                                'Their actions can have greater organizational consequences',
                                'They become slower',
                                'They stop using data',
                                'They cannot perform tasks',
                            ],
                            'correct_answer' => 'Their actions can have greater organizational consequences',
                        ],
                        [
                            'question' => 'Which is an important AI-agent control?',
                            'options' => ['Least-privilege access', 'Unlimited access', 'No logging', 'No approval points'],
                            'correct_answer' => 'Least-privilege access',
                        ],
                        [
                            'question' => 'What can an AI agent potentially do?',
                            'options' => ['Trigger approved workflows', 'Only display static text', 'Only print documents', 'Only store passwords'],
                            'correct_answer' => 'Trigger approved workflows',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-systems-and-risk',
                    'position' => 14,
                    'title' => 'AI Vendor & Third-Party Risk',
                    'description' => 'Assess AI vendors before allowing them to process organizational information.',
                    'content' => [
                        'Organizations should assess vendor reputation, security, privacy, data location, data retention, model-training practices, access controls, subcontractors, service reliability, contract terms, data deletion, incident notification and exit procedures.',
                        'Participants complete a sample AI Vendor Assessment Checklist.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which should be assessed before adopting an AI vendor?',
                            'options' => ['Security and privacy', 'Only logo design', 'Only office location', 'Only advertising'],
                            'correct_answer' => 'Security and privacy',
                        ],
                        [
                            'question' => 'Why should data retention be assessed?',
                            'options' => ['It determines how organizational information may be retained', 'It controls office seating', 'It changes employee salaries', 'It improves internet speed'],
                            'correct_answer' => 'It determines how organizational information may be retained',
                        ],
                        [
                            'question' => 'What should an organization consider when a vendor relationship ends?',
                            'options' => ['Data deletion and exit procedures', 'Nothing', 'More marketing', 'Employee uniforms'],
                            'correct_answer' => 'Data deletion and exit procedures',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-systems-and-risk',
                    'position' => 15,
                    'title' => 'AI Procurement',
                    'description' => 'Apply responsible AI checks before purchasing or subscribing to AI systems.',
                    'content' => [
                        'Before purchasing AI, consider: What problem does it solve? What information will it access? Who owns the information? Where is information processed? What security controls exist? Can the system be audited? What happens if the vendor relationship ends? What alternatives exist?',
                        'Procurement should connect business need with risk assessment, privacy, security, vendor assessment, legal or contract review, human oversight, testing and approval.',
                    ],
                    'questions' => [
                        [
                            'question' => 'What should come first in responsible AI procurement?',
                            'options' => ['Define the business need', 'Purchase immediately', 'Ignore risk', 'Give unlimited access'],
                            'correct_answer' => 'Define the business need',
                        ],
                        [
                            'question' => 'Which should be assessed before procurement?',
                            'options' => ['Privacy and security', 'Only price', 'Only branding', 'Only user interface'],
                            'correct_answer' => 'Privacy and security',
                        ],
                        [
                            'question' => 'What should happen before final approval?',
                            'options' => ['Appropriate assessment and testing', 'Immediate deployment', 'No review', 'No documentation'],
                            'correct_answer' => 'Appropriate assessment and testing',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-systems-and-risk',
                    'position' => 16,
                    'title' => 'AI Risk & Impact Assessment',
                    'description' => 'Classify AI use and assess potential impacts on people and organizations.',
                    'content' => [
                        'Lower risk example: AI brainstorming non-confidential meeting ideas.',
                        'Moderate risk example: AI drafts customer communications that employees review.',
                        'Higher risk example: AI materially influences recruitment, finance, healthcare, disciplinary, safety or similarly consequential decisions.',
                        'AI Impact Assessment should examine purpose, people affected, information used, potential harms, fairness, privacy, security, accuracy, human oversight, responsible owner, monitoring and escalation.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which is an example of lower-risk AI use?',
                            'options' => ['Brainstorming non-confidential meeting ideas', 'Automating disciplinary decisions', 'Making healthcare decisions', 'Approving financial transfers'],
                            'correct_answer' => 'Brainstorming non-confidential meeting ideas',
                        ],
                        [
                            'question' => 'What should an impact assessment examine?',
                            'options' => ['People affected and potential harms', 'Only software color', 'Only vendor logo', 'Only subscription price'],
                            'correct_answer' => 'People affected and potential harms',
                        ],
                        [
                            'question' => 'Which may represent higher-risk AI use?',
                            'options' => ['AI materially influencing recruitment decisions', 'Drafting a generic meeting agenda', 'Brainstorming slogans', 'Formatting a document'],
                            'correct_answer' => 'AI materially influencing recruitment decisions',
                        ],
                    ],
                ],

                // ---------------------------------------------------------
                // STAGE 4
                // ---------------------------------------------------------

                [
                    'stage' => 'ai-governance',
                    'position' => 17,
                    'title' => 'AI Governance',
                    'description' => 'Establish responsibility for AI from leadership to end users.',
                    'content' => [
                        'Governance structure: Board or Executive Leadership → AI Governance or Risk Committee → Legal, Compliance, IT, Cybersecurity and HR → Department Managers → Employees and AI Users.',
                        'Each significant AI system should have an identifiable owner.',
                    ],
                    'questions' => [
                        [
                            'question' => 'What should significant AI systems have?',
                            'options' => ['An identifiable owner', 'No owner', 'Unlimited users', 'No documentation'],
                            'correct_answer' => 'An identifiable owner',
                        ],
                        [
                            'question' => 'Where should AI governance begin?',
                            'options' => ['Leadership and organizational governance', 'Only individual employees', 'Only software vendors', 'Nowhere'],
                            'correct_answer' => 'Leadership and organizational governance',
                        ],
                        [
                            'question' => 'Which functions may contribute to AI governance?',
                            'options' => ['Legal, compliance, IT, cybersecurity and HR', 'Only marketing', 'Only sales', 'Only reception'],
                            'correct_answer' => 'Legal, compliance, IT, cybersecurity and HR',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-governance',
                    'position' => 18,
                    'title' => 'AI System Lifecycle Governance',
                    'description' => 'Govern AI systems from proposal through retirement.',
                    'content' => [
                        'AI governance continues throughout the lifecycle.',
                        'PROPOSE → ASSESS → APPROVE → BUILD/BUY → TEST → DEPLOY → MONITOR → AUDIT → RETIRE',
                        'Organizations should establish requirements for each stage.',
                    ],
                    'questions' => [
                        [
                            'question' => 'When should AI governance begin?',
                            'options' => ['At proposal and assessment', 'Only after an incident', 'Only after retirement', 'Never'],
                            'correct_answer' => 'At proposal and assessment',
                        ],
                        [
                            'question' => 'Which stage follows deployment in the lifecycle?',
                            'options' => ['Monitor', 'Forget', 'Delete immediately', 'Advertise'],
                            'correct_answer' => 'Monitor',
                        ],
                        [
                            'question' => 'Why govern the whole lifecycle?',
                            'options' => ['AI risks and requirements can change over time', 'Only procurement matters', 'Only deployment matters', 'Governance is unnecessary'],
                            'correct_answer' => 'AI risks and requirements can change over time',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-governance',
                    'position' => 19,
                    'title' => 'Testing, Monitoring & Auditing',
                    'description' => 'Continuously evaluate significant AI systems.',
                    'content' => [
                        'Organizations should periodically evaluate significant AI systems for accuracy, reliability, bias, security, performance, unexpected behavior, complaints, incidents, changes in use and continued appropriateness.',
                        'Responsible AI is an ongoing process rather than a one-time approval.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which should be monitored?',
                            'options' => ['Accuracy, reliability, bias and security', 'Only logo design', 'Only purchase price', 'Nothing'],
                            'correct_answer' => 'Accuracy, reliability, bias and security',
                        ],
                        [
                            'question' => 'Is responsible AI a one-time approval?',
                            'options' => ['No', 'Yes', 'Always', 'Only for small companies'],
                            'correct_answer' => 'No',
                        ],
                        [
                            'question' => 'What can trigger reassessment?',
                            'options' => ['Significant changes in use or incidents', 'Only office relocation', 'Only staff birthdays', 'Nothing'],
                            'correct_answer' => 'Significant changes in use or incidents',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-governance',
                    'position' => 20,
                    'title' => 'Documentation & Audit Trails',
                    'description' => 'Create evidence of how significant AI systems are governed.',
                    'content' => [
                        'Depending on the use case and applicable requirements, organizations may document the AI system, purpose, owner, vendor, approval, risk classification, relevant data, testing, significant changes, incidents, human-review requirements and review dates.',
                        'Principle: If an organization cannot explain how a significant AI system is being governed, its governance may need strengthening.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which belongs in AI governance documentation?',
                            'options' => ['System owner and risk classification', 'Only logo color', 'Only office location', 'Only marketing slogans'],
                            'correct_answer' => 'System owner and risk classification',
                        ],
                        [
                            'question' => 'Why maintain audit trails?',
                            'options' => ['To document how significant AI is governed', 'To eliminate all human review', 'To increase AI authority', 'To avoid responsibility'],
                            'correct_answer' => 'To document how significant AI is governed',
                        ],
                        [
                            'question' => 'What may indicate weak governance?',
                            'options' => ['The organization cannot explain how a significant AI system is governed', 'A system has an owner', 'Testing is documented', 'Review dates exist'],
                            'correct_answer' => 'The organization cannot explain how a significant AI system is governed',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-governance',
                    'position' => 21,
                    'title' => 'Customer-Facing AI & Transparency',
                    'description' => 'Use customer-facing AI responsibly and maintain appropriate escalation paths.',
                    'content' => [
                        'Participants learn responsible approaches to customer chatbots, AI voice agents, recommendation systems, automated communications and customer profiling.',
                        'Organizations should establish when customers can understand that AI is involved where appropriate, reach a human, question important outcomes, report errors and escalate complaints.',
                    ],
                    'questions' => [
                        [
                            'question' => 'What should a customer-facing AI system provide where appropriate?',
                            'options' => ['A path to human assistance', 'No escalation path', 'Unlimited automation', 'Hidden AI use in every situation'],
                            'correct_answer' => 'A path to human assistance',
                        ],
                        [
                            'question' => 'Which is a customer-facing AI application?',
                            'options' => ['Customer chatbot', 'Office printer', 'Paper filing', 'Building alarm'],
                            'correct_answer' => 'Customer chatbot',
                        ],
                        [
                            'question' => 'Why is transparency important?',
                            'options' => ['Customers may need to understand and question important AI-supported interactions', 'It removes all errors', 'It makes AI autonomous', 'It eliminates human support'],
                            'correct_answer' => 'Customers may need to understand and question important AI-supported interactions',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-governance',
                    'position' => 22,
                    'title' => 'Responsible AI in Sales & Marketing',
                    'description' => 'Use AI in marketing without intentionally misleading or deceiving customers.',
                    'content' => [
                        'Participants examine AI-generated advertisements, customer personalization, automated outreach, synthetic images, fake testimonials, customer profiling, misleading content and manipulative practices.',
                        'Principle: AI should enhance legitimate marketing—not be used to intentionally deceive customers.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which marketing practice creates a responsible AI concern?',
                            'options' => ['Fake testimonials', 'Verified customer information', 'Accurate product descriptions', 'Approved campaign review'],
                            'correct_answer' => 'Fake testimonials',
                        ],
                        [
                            'question' => 'What should responsible AI marketing avoid?',
                            'options' => ['Intentional deception', 'Human review', 'Accuracy checks', 'Appropriate disclosure'],
                            'correct_answer' => 'Intentional deception',
                        ],
                        [
                            'question' => 'Can AI generate marketing materials?',
                            'options' => ['Yes, with appropriate controls and review', 'Never', 'Only without review', 'Only for internal documents'],
                            'correct_answer' => 'Yes, with appropriate controls and review',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-governance',
                    'position' => 23,
                    'title' => 'Responsible AI in Finance',
                    'description' => 'Apply responsible controls to AI-assisted financial activity.',
                    'content' => [
                        'Topics include AI-assisted forecasting, fraud detection, invoice processing, payments, financial analysis, credit or risk support and approval workflows.',
                        'Important financial actions should maintain appropriate verification, authorization and segregation of duties.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which is an AI finance application?',
                            'options' => ['Fraud detection', 'Office decoration', 'Building maintenance', 'Employee parking'],
                            'correct_answer' => 'Fraud detection',
                        ],
                        [
                            'question' => 'What should important financial actions maintain?',
                            'options' => ['Verification and authorization', 'No review', 'Unlimited automation', 'No segregation of duties'],
                            'correct_answer' => 'Verification and authorization',
                        ],
                        [
                            'question' => 'Should AI alone authorize significant financial actions?',
                            'options' => ['Appropriate controls and human authorization should remain', 'Yes', 'Always', 'Without documentation'],
                            'correct_answer' => 'Appropriate controls and human authorization should remain',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-governance',
                    'position' => 24,
                    'title' => 'Accessibility & Inclusion',
                    'description' => 'Consider diverse users and circumstances when deploying AI.',
                    'content' => [
                        'AI should consider people with different abilities, languages, accents, literacy levels, digital access and cultural contexts.',
                        'Organizations should test whether systems unintentionally exclude users.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which user difference should AI teams consider?',
                            'options' => ['Language and ability', 'Only job title', 'Only department', 'Only age of software'],
                            'correct_answer' => 'Language and ability',
                        ],
                        [
                            'question' => 'What should organizations test for?',
                            'options' => ['Unintentional exclusion', 'Only system speed', 'Only cost', 'Nothing'],
                            'correct_answer' => 'Unintentional exclusion',
                        ],
                        [
                            'question' => 'Why does inclusion matter?',
                            'options' => ['AI systems can affect people with different circumstances', 'It removes the need for testing', 'It guarantees accuracy', 'It removes all risks'],
                            'correct_answer' => 'AI systems can affect people with different circumstances',
                        ],
                    ],
                ],

                [
                    'stage' => 'ai-governance',
                    'position' => 25,
                    'title' => 'AI Incident Management',
                    'description' => 'Recognize, contain, report and learn from AI incidents.',
                    'content' => [
                        'Potential incidents include confidential data exposure, incorrect AI information reaching customers, discriminatory output, security compromise, deepfake fraud, unauthorized AI use and unexpected autonomous actions.',
                        'RESPONSE PROCESS:',
                        'IDENTIFY → CONTAIN → REPORT → INVESTIGATE → CORRECT → DOCUMENT → LEARN',
                        'Employees should know exactly where and how to report suspected AI incidents.',
                    ],
                    'questions' => [
                        [
                            'question' => 'What should happen immediately after identifying a serious AI incident?',
                            'options' => ['Contain and report according to procedure', 'Hide it', 'Publish it publicly', 'Ignore it'],
                            'correct_answer' => 'Contain and report according to procedure',
                        ],
                        [
                            'question' => 'What comes first in the response process?',
                            'options' => ['Identify', 'Document', 'Learn', 'Correct'],
                            'correct_answer' => 'Identify',
                        ],
                        [
                            'question' => 'Why document incidents?',
                            'options' => ['To support learning and future controls', 'To hide mistakes', 'To remove accountability', 'To increase AI authority'],
                            'correct_answer' => 'To support learning and future controls',
                        ],
                    ],
                ],

                // ---------------------------------------------------------
                // STAGE 5
                // ---------------------------------------------------------

                [
                    'stage' => 'leadership-and-culture',
                    'position' => 26,
                    'title' => 'Corporate AI Acceptable-Use Policy',
                    'description' => 'Develop organizational rules for responsible employee AI use.',
                    'content' => [
                        'Participants develop rules covering approved uses, restricted uses, prohibited uses, data rules, human review, disclosure and incident reporting.',
                        'The policy should define what employees may do, what requires authorization, what employees must not do, what information can be provided to different AI systems, when humans must approve outputs and how problems are reported.',
                    ],
                    'questions' => [
                        [
                            'question' => 'What does an acceptable-use policy define?',
                            'options' => ['Approved, restricted and prohibited AI use', 'Only AI marketing', 'Only software pricing', 'Only employee salaries'],
                            'correct_answer' => 'Approved, restricted and prohibited AI use',
                        ],
                        [
                            'question' => 'What should data rules address?',
                            'options' => ['What information may be provided to different AI systems', 'Only office seating', 'Only employee uniforms', 'Only meeting times'],
                            'correct_answer' => 'What information may be provided to different AI systems',
                        ],
                        [
                            'question' => 'What should the policy say about incidents?',
                            'options' => ['How problems are reported', 'Nothing', 'How to hide them', 'How to delete evidence'],
                            'correct_answer' => 'How problems are reported',
                        ],
                    ],
                ],

                [
                    'stage' => 'leadership-and-culture',
                    'position' => 27,
                    'title' => 'Leadership, Board & Management Responsibility',
                    'description' => 'Understand leadership responsibilities for AI risk and opportunity.',
                    'content' => [
                        'Leadership responsibilities include governance, policy approval, risk tolerance, resource allocation, accountability, employee training, vendor oversight, incident escalation and periodic review.',
                        'AI governance should connect with cybersecurity, privacy, HR, legal, compliance, operational risk and financial controls.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Which is a leadership responsibility?',
                            'options' => ['Policy approval and accountability', 'Avoiding all governance', 'Removing all controls', 'Delegating every decision to AI'],
                            'correct_answer' => 'Policy approval and accountability',
                        ],
                        [
                            'question' => 'Which functions should AI governance connect with?',
                            'options' => ['Cybersecurity, privacy, HR, legal and compliance', 'Only marketing', 'Only reception', 'Only sales'],
                            'correct_answer' => 'Cybersecurity, privacy, HR, legal and compliance',
                        ],
                        [
                            'question' => 'Who should determine organizational risk tolerance?',
                            'options' => ['Appropriate organizational leadership and governance', 'An AI model alone', 'An anonymous employee', 'Nobody'],
                            'correct_answer' => 'Appropriate organizational leadership and governance',
                        ],
                    ],
                ],

                [
                    'stage' => 'leadership-and-culture',
                    'position' => 28,
                    'title' => 'Responsible AI Culture',
                    'description' => 'Build a culture where responsible AI practices are part of everyday work.',
                    'content' => [
                        'Policies alone are insufficient.',
                        'Organizations should develop a culture where employees ask questions, verify AI output, protect information, challenge questionable recommendations, report incidents, escalate concerns, understand accountability and continue learning.',
                        'Employees should be able to raise legitimate concerns about unsafe or inappropriate AI use without pressure to conceal problems.',
                    ],
                    'questions' => [
                        [
                            'question' => 'Why are policies alone insufficient?',
                            'options' => ['Responsible AI also requires everyday employee behavior and culture', 'Policies are always useless', 'AI cannot be governed', 'Employees have no role'],
                            'correct_answer' => 'Responsible AI also requires everyday employee behavior and culture',
                        ],
                        [
                            'question' => 'What should employees do with questionable AI recommendations?',
                            'options' => ['Challenge and escalate them appropriately', 'Automatically accept them', 'Hide them', 'Delete all records'],
                            'correct_answer' => 'Challenge and escalate them appropriately',
                        ],
                        [
                            'question' => 'What should employees be able to do?',
                            'options' => ['Raise legitimate concerns', 'Hide incidents', 'Avoid reporting', 'Bypass governance'],
                            'correct_answer' => 'Raise legitimate concerns',
                        ],
                    ],
                ],

                [
                    'stage' => 'leadership-and-culture',
                    'position' => 29,
                    'title' => 'Moose Loon Responsible AI Check',
                    'description' => 'Use a practical checklist before using AI professionally.',
                    'content' => [
                        'PURPOSE — Why am I using AI?',
                        'PERMISSION — Is the tool and use approved?',
                        'PRIVACY — Am I exposing protected information?',
                        'ACCURACY — Have important facts been verified?',
                        'FAIRNESS — Could someone be unfairly affected?',
                        'SECURITY — Could this expose organizational systems or information?',
                        'OWNERSHIP — Are there intellectual-property concerns?',
                        'TRANSPARENCY — Does AI involvement require disclosure?',
                        'HUMAN REVIEW — Has an appropriate person reviewed the output?',
                        'ACCOUNTABILITY — Who is responsible for the final decision?',
                        'WHEN IN DOUBT: STOP → CHECK → ASK → VERIFY → THEN ACT',
                    ],
                    'questions' => [
                        [
                            'question' => 'What should you ask about privacy?',
                            'options' => ['Am I exposing protected information?', 'Can I skip verification?', 'Can I hide the AI?', 'Can I upload everything?'],
                            'correct_answer' => 'Am I exposing protected information?',
                        ],
                        [
                            'question' => 'What should happen when in doubt?',
                            'options' => ['STOP → CHECK → ASK → VERIFY → THEN ACT', 'Act immediately', 'Ignore the concern', 'Upload more data'],
                            'correct_answer' => 'STOP → CHECK → ASK → VERIFY → THEN ACT',
                        ],
                        [
                            'question' => 'What does ACCOUNTABILITY ask?',
                            'options' => ['Who is responsible for the final decision?', 'Who designed the logo?', 'Who bought the computer?', 'Who owns the office?'],
                            'correct_answer' => 'Who is responsible for the final decision?',
                        ],
                    ],
                ],

                // ---------------------------------------------------------
                // STAGE 6
                // ---------------------------------------------------------

                [
                    'stage' => 'implementation',
                    'position' => 30,
                    'title' => 'Corporate Responsible AI Implementation Workshop',
                    'description' => 'Build a practical Corporate Responsible AI Implementation Pack.',
                    'content' => [
                        'This is the practical implementation stage of the program.',
                        'Participants apply responsible AI principles directly to their organization.',
                        'The objective is to produce a Corporate Responsible AI Implementation Pack.',
                        'Deliverables include: Corporate AI Acceptable-Use Policy; AI System Inventory; Approved AI Tools Register; Prohibited and Restricted AI Uses List; AI Risk Register; AI Impact Assessment; AI Vendor Assessment Checklist; AI Incident Response Procedure; Employee Responsible AI Checklist; AI Governance Structure; AI Training and Awareness Plan; AI Monitoring and Review Plan; AI Procurement Checklist; and a 90-Day Responsible AI Action Plan.',
                        '90-DAY PLAN — DAYS 1–30 DISCOVER: identify AI tools, Shadow AI, owners and immediate risks.',
                        'DAYS 31–60 GOVERN: approve policy, classify systems, establish approved tools, conduct priority assessments, establish incident procedures and train employees.',
                        'DAYS 61–90 IMPLEMENT & MONITOR: implement controls, review vendors, monitor significant systems, test incident procedures, review compliance and report progress to leadership.',
                        'Final practical assessment: identify risks, classify AI applications, identify unauthorized use, recommend controls, determine human oversight, identify data risks, respond to an AI incident, recommend governance responsibilities, develop an acceptable-use approach and present recommendations to management.',
                    ],
                    'questions' => [
                        [
                            'question' => 'What is the main practical outcome of the workshop?',
                            'options' => [
                                'Corporate Responsible AI Implementation Pack',
                                'A new AI model',
                                'A software application',
                                'A marketing campaign',
                            ],
                            'correct_answer' => 'Corporate Responsible AI Implementation Pack',
                        ],
                        [
                            'question' => 'What is the first phase of the 90-day plan?',
                            'options' => ['Discover', 'Govern', 'Monitor', 'Retire'],
                            'correct_answer' => 'Discover',
                        ],
                        [
                            'question' => 'What should the final practical assessment require?',
                            'options' => [
                                'Identify risks and recommend appropriate controls',
                                'Memorize software code',
                                'Build an AI model',
                                'Purchase an AI vendor',
                            ],
                            'correct_answer' => 'Identify risks and recommend appropriate controls',
                        ],
                    ],
                ],
            ];

            foreach ($modules as $moduleData) {
                $stage = $stageModels[$moduleData['stage']];

                $module = Module::updateOrCreate(
                    [
                        'course_id' => $course->id,
                        'position' => $moduleData['position'],
                    ],
                    [
                        'course_stage_id' => $stage->id,
                        'title' => $moduleData['title'],
                        'description' => $moduleData['description'],
                    ]
                );

                /*
                 * One structured episode per module keeps the initial
                 * corporate course implementation compact while still
                 * using SynFlow's existing Episode -> LessonBlock model.
                 */
                $episode = Episode::updateOrCreate(
                    [
                        'module_id' => $module->id,
                        'position' => 1,
                    ],
                    [
                        'title' => $moduleData['title'],
                        'description' => $moduleData['description'],
                        'video_url' => null,
                        'pdf_path' => null,
                        'type' => 'lesson',
                    ]
                );

                LessonBlock::where('episode_id', $episode->id)->delete();

                foreach ($moduleData['content'] as $position => $content) {
                    LessonBlock::create([
                        'episode_id' => $episode->id,
                        'type' => 'text',
                        'title' => $position === 0
                            ? $moduleData['title']
                            : null,
                        'content' => $content,
                        'metadata' => null,
                        'position' => $position + 1,
                    ]);
                }

                $quiz = Quiz::updateOrCreate(
                    [
                        'module_id' => $module->id,
                        'position' => 1,
                    ],
                    [
                        'title' => $moduleData['title'] . ' — Knowledge Check',
                        'description' => 'Knowledge check for ' . $moduleData['title'],
                    ]
                );

                QuizQuestion::where('quiz_id', $quiz->id)->delete();

                foreach ($moduleData['questions'] as $position => $question) {
                    $optionKeys = range('A', 'Z');
                    $normalizedOptions = [];

                    foreach (array_values($question['options']) as $index => $option) {
                        $normalizedOptions[$optionKeys[$index]] = $option;
                    }

                    $correctAnswer = array_search(
                        $question['correct_answer'],
                        $normalizedOptions,
                        true
                    );

                    if ($correctAnswer === false) {
                        throw new \RuntimeException(
                            "Corporate quiz question has no matching correct answer: "
                            . $question['question']
                        );
                    }

                    QuizQuestion::create([
                        'quiz_id' => $quiz->id,
                        'question' => $question['question'],
                        'options' => $normalizedOptions,
                        'correct_answer' => $correctAnswer,
                        'position' => $position + 1,
                    ]);
                }

                Assignment::updateOrCreate(
                    [
                        'module_id' => $module->id,
                        'position' => 1,
                    ],
                    [
                        'title' => $moduleData['title'] . ' — Practical Exercise',
                        'instructions' => $this->assignmentInstructions(
                            $moduleData['title'],
                            $moduleData['content']
                        ),
                        'submission_type' => 'text',
                    ]
                );
            }
        });
    }

    private function assignmentInstructions(
        string $moduleTitle,
        array $content
    ): string {
        return <<<TEXT
Corporate Responsible AI Practical Exercise

Module: {$moduleTitle}

Review the concepts covered in this module and apply them to a realistic workplace situation.

Your response should:
1. Identify the relevant AI use or risk.
2. Explain who or what could be affected.
3. Identify the information, decision or process involved.
4. Recommend appropriate controls.
5. Explain where human oversight is required.
6. State who should be accountable.
7. Recommend one practical improvement the organization could implement.

Use examples from your own department or a realistic fictional organization.

Do not submit confidential, personal, proprietary or otherwise sensitive organizational information.
TEXT;
    }
}
