<?php

namespace App\Http\Controllers;

use App\Company;
use App\Event;
use App\Events;
use App\Events\CompUser;
use App\Events\NewUser;
use App\MemberFiles;
use App\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\EventController as EventController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\Writer;
use Schema;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * @var array
     */
    public $data;
    public $user;
    public $event;
    public $company;

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $activeMembers = $this->getActiveAccounts();
        $expiring = $this->getExpiringAccounts();
        $newMembers = $this->getMonthlyNewMembers();
        $renewedMembers = $this->getRenewedMembers();

        $this->user = new User;
        $this->event = new Event;
        $this->company = new Company;
        $this->data = [
            'activeMembers' => $activeMembers,
            'totalMembers' => $this->user->count(),
            'expiringMembers' => $expiring,
            'newMembers' => $newMembers,
            'renewedMembers' => $renewedMembers,
        ];
        $this->data['states'] = array(
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District Of Columbia',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
            'OS' => 'Outside United States',
            '' => '',
            'AB' => 'Alberta',
            'BC' => 'Brittish Columbia',
            'ENG' => 'England UK',
            'MB' => 'Manitoba',
            'NB' => 'New Brunswick',
            'NL' => 'Newfoundland and Labrador',
            'NT' => 'Northwest Territories',
            'NS' => 'Nova Scotia',
            'NU' => 'Nunavut',
            'ON' => 'Ontario',
            'PE' => 'Prince Edward Island',
            'QC' => 'Quebec',
            'SK' => 'Saskatchewan',
            'YT' => 'Yukon',
            'WAL' => 'Wales',
            'IE' => 'Ireland',
            'SCT'=> 'Scotland',
            'ENG' => 'England',
        );
        $this->data['country'] = array(
            'US' => 'United States',
            'AF' => 'Afghanistan',
            'AX' => 'Aland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua And Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia And Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, Democratic Republic',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Cote D\'Ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island & Mcdonald Islands',
            'VA' => 'Holy See (Vatican City State)',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran, Islamic Republic Of',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle Of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KR' => 'Korea',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Lao People\'s Democratic Republic',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libyan Arab Jamahiriya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia, Federated States Of',
            'MD' => 'Moldova',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory, Occupied',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'BL' => 'Saint Barthelemy',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts And Nevis',
            'LC' => 'Saint Lucia',
            'MF' => 'Saint Martin',
            'PM' => 'Saint Pierre And Miquelon',
            'VC' => 'Saint Vincent And Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome And Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia And Sandwich Isl.',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard And Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania',
            'TH' => 'Thailand',
            'TL' => 'Timor-Leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad And Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks And Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VE' => 'Venezuela',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands, British',
            'VI' => 'Virgin Islands, U.S.',
            'WF' => 'Wallis And Futuna',
            'WAL' => 'Wales',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
        );
        $this->data['industry'] = array(
            'Academia' => 'Academia',
            'Advertising/Design' => 'Advertising/Design',
            'Aerosol Color Sprays' => 'Aerosol Color Sprays',
            'Aluminum Printing' => 'Aluminum Printing',
            'Architectural Coating' => 'Architectural Coating',
            'Architectural Colour & Material' => 'Architectural Colour & Material',
            'Architecture' => 'Architecture',
            'Architecture & Design' => 'Architecture & Design',
            'Automotive' => 'Automotive',
            'Automotive Aftermarket' => 'Automotive Aftermarket',
            'Automotive Chemicals' => 'Automotive Chemicals',
            'Biking Manufacturer' => 'Biking Manufacturer',
            'Bldg Materials' => 'Bldg Materials',
            'Bldg Materials/Mfgr Laminate' => 'Bldg Materials/Mfgr Laminate',
            'Branding' => 'Branding',
            'Building Products' => 'Building Products',
            'Cabinet Manufacturer' => 'Cabinet Manufacturer',
            'Cabinetry Colors' => 'Cabinetry Colors',
            'Cabinetry/Furniture' => 'Cabinetry/Furniture',
            'Carpet/Rug' => 'Carpet/Rug',
            'Ceramic Tile' => 'Ceramic Tile',
            'Chemical Industry' => 'Chemical Industry',
            'Chemistry' => 'Chemistry',
            'Coatings' => 'Coatings',
            'Color' => 'Color',
            'Color & Design Consulting' => 'Color & Design Consulting',
            'Color Design of Facades' => 'Color Design of Facades',
            'Color Design/Surface Design' => 'Color Design/Surface Design',
            'Color Samples' => 'Color Samples',
            'Color Science/ Interior Design' => 'Color Science/ Interior Design',
            'Color Solutions' => 'Color Solutions',
            'Color Tools' => 'Color Tools',
            'Colorant Dispersions' => 'Colorant Dispersions',
            'Colorants' => 'Colorants',
            'Colour' => 'Colour',
            'Commercial Carpet' => 'Commercial Carpet',
            'Commercial Carpet Fiber' => 'Commercial Carpet Fiber',
            'Commercial Construction/Exterior' => 'Commercial Construction/Exterior',
            'Commercial Flooring' => 'Commercial Flooring',
            'Commercial Interiors' => 'Commercial Interiors',
            'Commercial Office Furniture' => 'Commercial Office Furniture',
            'Commerical LVT Flooring' => 'Commerical LVT Flooring',
            'Consultancy' => 'Consultancy',
            'Consumer electronics' => 'Consumer electronics',
            'Consumer Goods' => 'Consumer Goods',
            'Consumer Products' => 'Consumer Products',
            'Contract Carpet' => 'Contract Carpet',
            'Contract Furniture' => 'Contract Furniture',
            'Contract Wallcovering' => 'Contract Wallcovering',
            'Conventions' => 'Conventions',
            'Corporate, Healthcare, Education' => 'Corporate, Healthcare, Education',
            'Cosmetics' => 'Cosmetics',
            'Craft - Handknitting Yarn' => 'Craft - Handknitting Yarn',
            'Data Collection & Mgmt' => 'Data Collection & Mgmt',
            'Decorating' => 'Decorating',
            'Decorative Coatings' => 'Decorative Coatings',
            'Decorative Laminates' => 'Decorative Laminates',
            'Decorative Printer Paper' => 'Decorative Printer Paper',
            'Decorative Surfaces' => 'Decorative Surfaces',
            'Design' => 'Design',
            'Design & Architectural Software' => 'Design & Architectural Software',
            'Design & Innovation' => 'Design & Innovation',
            'Design Marketing' => 'Design Marketing',
            'Education' => 'Education',
            'Effect Pigments' => 'Effect Pigments',
            'Entertainment' => 'Entertainment',
            'Event Design/Hospitality Design' => 'Event Design/Hospitality Design',
            'Fabric Converter' => 'Fabric Converter',
            'Fashion' => 'Fashion',
            'Floor covering' => 'Floor covering',
            'Flooring' => 'Flooring',
            'Flooring distributor' => 'Flooring distributor',
            'Flooring/ Ceramic Accessories' => 'Flooring/ Ceramic Accessories',
            'Food Color/Decorations' => 'Food Color/Decorations',
            'Furniture' => 'Furniture',
            'Furniture Manufacturing' => 'Furniture Manufacturing',
            'Gardening Consumer Goods' => 'Gardening Consumer Goods',
            'Global Design Consultant' => 'Global Design Consultant',
            'Graphic Design' => 'Graphic Design',
            'Graphic Design/Photography/Color Gem Stones' => 'Graphic Design/Photography/Color Gem Stones',
            'Graphic/Industrial Design' => 'Graphic/Industrial Design',
            'Hard Goods/Home Décor' => 'Hard Goods/Home Décor',
            'Hard Surfacing' => 'Hard Surfacing',
            'Hardware' => 'Hardware',
            'High-Performance blenders' => 'High-Performance blenders',
            'Home Building' => 'Home Building',
            'Home décor' => 'Home décor',
            'Home Furnishings' => 'Home Furnishings',
            'Home Interiors' => 'Home Interiors',
            'Home Textiles' => 'Home Textiles',
            'Home/Architectural Coatings' => 'Home/Architectural Coatings',
            'Home/Cabinetry' => 'Home/Cabinetry',
            'Housewares' => 'Housewares',
            'Industrial Coatings' => 'Industrial Coatings',
            'Interior Decorative Surfaces' => 'Interior Decorative Surfaces',
            'Interior Design' => 'Interior Design',
            'Interior Surfacing Products' => 'Interior Surfacing Products',
            'Kitchen Cabinets' => 'Kitchen Cabinets',
            'Laminates' => 'Laminates',
            'Leather' => 'Leather',
            'Lifestyle' => 'Lifestyle',
            'Liquid & Powder Coatings' => 'Liquid & Powder Coatings',
            'Manufacturer of Plastic Housewares' => 'Manufacturer of Plastic Housewares',
            'Manufacturers, Laminates' => 'Manufacturers, Laminates',
            'Manufacturing' => 'Manufacturing',
            'Manufacturing Flooring' => 'Manufacturing Flooring',
            'Manufacturing/Distribution' => 'Manufacturing/Distribution',
            'Marine' => 'Marine',
            'Marketing' => 'Marketing',
            'Marketing & Design' => 'Marketing & Design',
            'Masterbatch Producer' => 'Masterbatch Producer',
            'Material Supplier' => 'Material Supplier',
            'Materials Manufacturer' => 'Materials Manufacturer',
            'Mattress Ticking' => 'Mattress Ticking',
            'New Home Construction/ Home Interiors' => 'New Home Construction/ Home Interiors',
            'New Residential Home Construction' => 'New Residential Home Construction',
            'OEM Paint Supplier' => 'OEM Paint Supplier',
            'Office Furniture' => 'Office Furniture',
            'Outdoor, Home' => 'Outdoor, Home',
            'Paint' => 'Paint',
            'Paint & Coatings' => 'Paint & Coatings',
            'Paint & Furniture' => 'Paint & Furniture',
            'Paint & Specialty Coatings' => 'Paint & Specialty Coatings',
            'Paint Manufacturers' => 'Paint Manufacturers',
            'Paint/Stains/Design & Colour' => 'Paint/Stains/Design & Colour',
            'Paint/Wallcoverings' => 'Paint/Wallcoverings',
            'Paper printing' => 'Paper printing',
            'Performance Materials/Pigments' => 'Performance Materials/Pigments',
            'Personal Electronics' => 'Personal Electronics',
            'Plastic Compounding' => 'Plastic Compounding',
            'Plastics' => 'Plastics',
            'Plastics & Coatings' => 'Plastics & Coatings',
            'Plastics & Masterbatch' => 'Plastics & Masterbatch',
            'Plastics Color' => 'Plastics Color',
            'Plastics Compounding' => 'Plastics Compounding',
            'Plastics Packaging' => 'Plastics Packaging',
            'Powder Coatings' => 'Powder Coatings',
            'Prine' => 'Prine',
            'Printers of Décor Paper' => 'Printers of Décor Paper',
            'Product Development Consulting' => 'Product Development Consulting',
            'Promotional' => 'Promotional',
            'Quartz & Marble Manufacturer' => 'Quartz & Marble Manufacturer',
            'Residential  ' => 'Residential  ',
            'Residential & Commercial Interiors' => 'Residential & Commercial Interiors',
            'Residential Cabinetry' => 'Residential Cabinetry',
            'Residential Carpet' => 'Residential Carpet',
            'Residential Upholstery' => 'Residential Upholstery',
            'Residential/Commercial' => 'Residential/Commercial',
            'Retail (Home)' => 'Retail (Home)',
            'Retail Paint & Interior Design' => 'Retail Paint & Interior Design',
            'Seasonal décor' => 'Seasonal décor',
            'Services' => 'Services',
            'Small Domestic Appliances' => 'Small Domestic Appliances',
            'Soft Floor Covering' => 'Soft Floor Covering',
            'Specialty Coatings' => 'Specialty Coatings',
            'Sport' => 'Sport',
            'Surfacing' => 'Surfacing',
            'Tech' => 'Tech',
            'Textile Flooring' => 'Textile Flooring',
            'Textiles' => 'Textiles',
            'Textiles Furniture' => 'Textiles Furniture',
            'Thermoplastics' => 'Thermoplastics',
            'Tile & Ceramics' => 'Tile & Ceramics',
            'Tile Manufacturing' => 'Tile Manufacturing',
            'Trend Forecasting' => 'Trend Forecasting',
            'Trend Research   ' => 'Trend Research   ',
            'Trend Research & Innovation' => 'Trend Research & Innovation',
            'Vinyl - Window Coverings' => 'Vinyl - Window Coverings',
            'Wall Décor' => 'Wall Décor',
            'White Goods' => 'White Goods',
            'Window coverings' => 'Window coverings',
            'Wood based panels' => 'Wood based panels',
            'Wood Products' => 'Wood Products',
            'Woven Upholstery' => 'Woven Upholstery'
        );
        $this->data['position'] = array(
            'Account Executive' => 'Account Executive',
            'Account Manager' => 'Account Manager',
            'Advanced Materials Manager' => 'Advanced Materials Manager',
            'Advertising Coordinator' => 'Advertising Coordinator',
            'Advertising Manager' => 'Advertising Manager',
            'Architect' => 'Architect',
            'Architectural Consultant' => 'Architectural Consultant',
            'Architectural Interiors Rep.' => 'Architectural Interiors Rep.',
            'Art Director' => 'Art Director',
            'Artist' => 'Artist',
            'Assoc Category Manager' => 'Assoc Category Manager',
            'Associate Art Director' => 'Associate Art Director',
            'Associate Designer' => 'Associate Designer',
            'Associate Production Designer' => 'Associate Production Designer',
            'Associate Professor' => 'Associate Professor',
            'Brand Coordinator' => 'Brand Coordinator',
            'Brand Manager' => 'Brand Manager',
            'Brand Marketing Director' => 'Brand Marketing Director',
            'Category Director' => 'Category Director',
            'Category Manager, Product Development' => 'Category Manager, Product Development',
            'CEO' => 'CEO',
            'Chair of the Graduate Studies Dept' => 'Chair of the Graduate Studies Dept',
            'Chief Creative Officer' => 'Chief Creative Officer',
            'Chief Executive Officer' => 'Chief Executive Officer',
            'Chief Marketing Officer' => 'Chief Marketing Officer',
            'CMF Design Manager' => 'CMF Design Manager',
            'CMF Designer' => 'CMF Designer',
            'CMF Global Color Lead' => 'CMF Global Color Lead',
            'CMF Lead' => 'CMF Lead',
            'Color & Design Consultant' => 'Color & Design Consultant',
            'Color & Materials Designer' => 'Color & Materials Designer',
            'Color & Materials Finish Designer' => 'Color & Materials Finish Designer',
            'Color & Materials Manager' => 'Color & Materials Manager',
            'Color & Trend Consultant' => 'Color & Trend Consultant',
            'Color Consultant' => 'Color Consultant',
            'Color Design Studio Manager' => 'Color Design Studio Manager',
            'Color Insight Manager' => 'Color Insight Manager',
            'Color Lab Manager' => 'Color Lab Manager',
            'Color Marketing & Decor Prod Mgr' => 'Color Marketing & Decor Prod Mgr',
            'Color Marketing & Design Specialist' => 'Color Marketing & Design Specialist',
            'Color Marketing Manager' => 'Color Marketing Manager',
            'Color Marketing Project Manager' => 'Color Marketing Project Manager',
            'Color Material Finish Administrator' => 'Color Material Finish Administrator',
            'Color Planner' => 'Color Planner',
            'Color Science Manager' => 'Color Science Manager',
            'Color Specialist' => 'Color Specialist',
            'Color Strategist' => 'Color Strategist',
            'Color Stylist' => 'Color Stylist',
            'Coloristik / Coloristic' => 'Coloristik / Coloristic',
            'Colour & Design Manager' => 'Colour & Design Manager',
            'Colour & Design Specialist' => 'Colour & Design Specialist',
            'Colour Planning & Communications Manager' => 'Colour Planning & Communications Manager',
            'Comercial Director, China' => 'Comercial Director, China',
            'Concept Designer' => 'Concept Designer',
            'Consultant' => 'Consultant',
            'Corporate Color Coordinator' => 'Corporate Color Coordinator',
            'Corporate Design Management' => 'Corporate Design Management',
            'Corporate Interior Designer' => 'Corporate Interior Designer',
            'Creative Director' => 'Creative Director',
            'Creative Manager' => 'Creative Manager',
            'Design & Developent Engineer' => 'Design & Developent Engineer',
            'Design Associate' => 'Design Associate',
            'Design Consultant' => 'Design Consultant',
            'Design Coordinator' => 'Design Coordinator',
            'Design Development Manager' => 'Design Development Manager',
            'Design Director' => 'Design Director',
            'Design Manager' => 'Design Manager',
            'Design Manager - Creative Services' => 'Design Manager - Creative Services',
            'Designer' => 'Designer',
            'Diector of Market Development' => 'Diector of Market Development',
            'Digital Marketing & Creative Director' => 'Digital Marketing & Creative Director',
            'Digital Marketing & Design Manager' => 'Digital Marketing & Design Manager',
            'Director' => 'Director',
            'Director - Architect & Design Channel' => 'Director - Architect & Design Channel',
            'Director BU Coatings & Plastics' => 'Director BU Coatings & Plastics',
            'Director of Business Development & Marketing' => 'Director of Business Development & Marketing',
            'Director of Color Marketing' => 'Director of Color Marketing',
            'Director of Contract Prints' => 'Director of Contract Prints',
            'Director of Creative' => 'Director of Creative',
            'Director of Design' => 'Director of Design',
            'Director of Design & Development' => 'Director of Design & Development',
            'Director of Education' => 'Director of Education',
            'Director of Global Marketing' => 'Director of Global Marketing',
            'Director of Global Product Design' => 'Director of Global Product Design',
            'Director of Manufacturing' => 'Director of Manufacturing',
            'Director of Marketing' => 'Director of Marketing',
            'Director of Marketing Services' => 'Director of Marketing Services',
            'Director of Product Design ' => 'Director of Product Design ',
            'Director of Product Dev & Design' => 'Director of Product Dev & Design',
            'Director of Product Management' => 'Director of Product Management',
            'Director of Sales & Marketing' => 'Director of Sales & Marketing',
            'Director Residential Styling' => 'Director Residential Styling',
            'Director Special Products' => 'Director Special Products',
            'Director,  Designer Relations & Education' => 'Director,  Designer Relations & Education',
            'Director, Interactive Stratety & Design' => 'Director, Interactive Stratety & Design',
            'Director, New Product Development' => 'Director, New Product Development',
            'EVP Design' => 'EVP Design',
            'Executive Communications Manager' => 'Executive Communications Manager',
            'Executive Vice President' => 'Executive Vice President',
            'Founder & Chief Colour Strategist' => 'Founder & Chief Colour Strategist',
            'Freelance Designer' => 'Freelance Designer',
            'Global Marketing' => 'Global Marketing',
            'Graphic Color Specialist' => 'Graphic Color Specialist',
            'Graphic Design   ' => 'Graphic Design   ',
            'Graphic Designer' => 'Graphic Designer',
            'Group VP - Design & Innovation' => 'Group VP - Design & Innovation',
            'Head of Colorworks & Color Communication' => 'Head of Colorworks & Color Communication',
            'Head of Corporate Design Management' => 'Head of Corporate Design Management',
            'Head of Design North America/Coatings Color & Design' => 'Head of Design North America/Coatings Color & Design',
            'Head of Market Development' => 'Head of Market Development',
            'Healthcare Market Manager' => 'Healthcare Market Manager',
            'Independent Color Consultant' => 'Independent Color Consultant',
            'Industrial Design Manager' => 'Industrial Design Manager',
            'In-house Designer' => 'In-house Designer',
            'Integrated Marketing Manager' => 'Integrated Marketing Manager',
            'Interior Designer' => 'Interior Designer',
            'Interior Designer/Kitchen & Bath' => 'Interior Designer/Kitchen & Bath',
            'International Product Executive' => 'International Product Executive',
            'International Sales Manager' => 'International Sales Manager',
            'Kitchen Design Specialist' => 'Kitchen Design Specialist',
            'Lead CMF Designer' => 'Lead CMF Designer',
            'Lifestyle Manager' => 'Lifestyle Manager',
            'Manager of Color Marketing' => 'Manager of Color Marketing',
            'Manager of Design' => 'Manager of Design',
            'Managing Director' => 'Managing Director',
            'Market Development Specialist' => 'Market Development Specialist',
            'Market Research Manager' => 'Market Research Manager',
            'Marketing' => 'Marketing',
            'Marketing & Sales Coordinator' => 'Marketing & Sales Coordinator',
            'Marketing & Sales Director' => 'Marketing & Sales Director',
            'Marketing & Training Manager' => 'Marketing & Training Manager',
            'Marketing Communications Director' => 'Marketing Communications Director',
            'Marketing Communications Manager' => 'Marketing Communications Manager',
            'Marketing Coordinator' => 'Marketing Coordinator',
            'Marketing Creative Director' => 'Marketing Creative Director',
            'Marketing Director' => 'Marketing Director',
            'Marketing Manager' => 'Marketing Manager',
            'Marketing Manager, Packaging' => 'Marketing Manager, Packaging',
            'Marketing Program Manager' => 'Marketing Program Manager',
            'Marketing Project Manager' => 'Marketing Project Manager',
            'Marketing Services Manager' => 'Marketing Services Manager',
            'Marketing Specialist' => 'Marketing Specialist',
            'Marketing|Business Development Mgr' => 'Marketing|Business Development Mgr',
            'Merchandising Manager' => 'Merchandising Manager',
            'Merchandising Specialist of Color & Design' => 'Merchandising Specialist of Color & Design',
            'National Color Lab Manager' => 'National Color Lab Manager',
            'National Design Director' => 'National Design Director',
            'National Director of Specification' => 'National Director of Specification',
            'National Manager of Design' => 'National Manager of Design',
            'New Business Development Manager' => 'New Business Development Manager',
            'Owner' => 'Owner',
            'Owner/Graphic Designer' => 'Owner/Graphic Designer',
            'Owner/President' => 'Owner/President',
            'Paints & Plastics Market Manager' => 'Paints & Plastics Market Manager',
            'President' => 'President',
            'Principal' => 'Principal',
            'Principal Designer' => 'Principal Designer',
            'Principal/Director of Design' => 'Principal/Director of Design',
            'Principle' => 'Principle',
            'Product & Brand Manager' => 'Product & Brand Manager',
            'Product & Merchandising Manager' => 'Product & Merchandising Manager',
            'Product Category Manager' => 'Product Category Manager',
            'Product Coordinator' => 'Product Coordinator',
            'Product Customization Supervisor' => 'Product Customization Supervisor',
            'Product Design & Development Asst.' => 'Product Design & Development Asst.',
            'Product Design Assistant' => 'Product Design Assistant',
            'Product Design Manager' => 'Product Design Manager',
            'Product Designer' => 'Product Designer',
            'Product Development Associate Manager' => 'Product Development Associate Manager',
            'Product Development Coordinator' => 'Product Development Coordinator',
            'Product Development Manager' => 'Product Development Manager',
            'Product Manager' => 'Product Manager',
            'Product Marketing Manager' => 'Product Marketing Manager',
            'Product Planning Analyst' => 'Product Planning Analyst',
            'Project Manager' => 'Project Manager',
            'Residential Design Director' => 'Residential Design Director',
            'Sales Executive' => 'Sales Executive',
            'Senior At Director' => 'Senior At Director',
            'Senior Chemist' => 'Senior Chemist',
            'Senior CMF Designer' => 'Senior CMF Designer',
            'Senior Design Engineer' => 'Senior Design Engineer',
            'Senior Designer' => 'Senior Designer',
            'Senior Director, Global Product Manager' => 'Senior Director, Global Product Manager',
            'Senior Graphic Designer' => 'Senior Graphic Designer',
            'Senior Marketing Manager' => 'Senior Marketing Manager',
            'Senior Product Design Manager' => 'Senior Product Design Manager',
            'Senior Product Designer' => 'Senior Product Designer',
            'Senior Product Manager' => 'Senior Product Manager',
            'Senior Stylist' => 'Senior Stylist',
            'Senior Vice President, Marketing' => 'Senior Vice President, Marketing',
            'Snr Design Process Cordinator' => 'Snr Design Process Cordinator',
            'Snr Director of Design & Sales' => 'Snr Director of Design & Sales',
            'Snr Laboratory Technologist' => 'Snr Laboratory Technologist',
            'Specifications Manager' => 'Specifications Manager',
            'Sr Designer' => 'Sr Designer',
            'Sr Designer National Accounts' => 'Sr Designer National Accounts',
            'Sr Director, Product Development & Design' => 'Sr Director, Product Development & Design',
            'SR Graphic Designer' => 'SR Graphic Designer',
            'Sr Manager - Business Strategy Execution' => 'Sr Manager - Business Strategy Execution',
            'Sr Manager, Design Studio' => 'Sr Manager, Design Studio',
            'Sr Project Chemist' => 'Sr Project Chemist',
            'Sr. Director of Brand Marketing' => 'Sr. Director of Brand Marketing',
            'Sr. Director of Marketing' => 'Sr. Director of Marketing',
            'Sr. VP Product Development' => 'Sr. VP Product Development',
            'Strategic Account Director' => 'Strategic Account Director',
            'Style Product Manager' => 'Style Product Manager',
            'Supervisor - Product Design' => 'Supervisor - Product Design',
            'tbc' => 'tbc',
            'Tech Mgr Decorative Coatings' => 'Tech Mgr Decorative Coatings',
            'Technical Product Specialist' => 'Technical Product Specialist',
            'Technical Sales Director' => 'Technical Sales Director',
            'Technical Service' => 'Technical Service',
            'Textile Designer' => 'Textile Designer',
            'Textile Market Manager' => 'Textile Market Manager',
            'Textiles Product Manager' => 'Textiles Product Manager',
            'TFL Product Manager' => 'TFL Product Manager',
            'Trend Director' => 'Trend Director',
            'Trend Research Manager' => 'Trend Research Manager',
            'US Product Manager' => 'US Product Manager',
            'Variable Inc' => 'Variable Inc',
            'Vice President' => 'Vice President',
            'Vice President of Product & Marketing' => 'Vice President of Product & Marketing',
            'Vice President, Marketing' => 'Vice President, Marketing',
            'Vice President/Creative Director' => 'Vice President/Creative Director',
            'VP Client Strategy & Brand Development' => 'VP Client Strategy & Brand Development',
            'VP Marketing' => 'VP Marketing',
            'VP Marketing & Product Development' => 'VP Marketing & Product Development',
            'VP of Consumer Color Solutions' => 'VP of Consumer Color Solutions',
            'VP of Design' => 'VP of Design',
            'VP of Interior Design' => 'VP of Interior Design',
            'VP of Marketing ' => 'VP of Marketing ',
            'VP of Marketing & Product Management' => 'VP of Marketing & Product Management',
            'VP Product Development' => 'VP Product Development',
            'VP Residential Styling' => 'VP Residential Styling',
            'VP Sales & Marketing' => 'VP Sales & Marketing',
            'VP, Creative Director' => 'VP, Creative Director',
            'VP, Innovation & Worldwide Development' => 'VP, Innovation & Worldwide Development',
            'Weaveup Project Manager' => 'Weaveup Project Manager',
            'Web Content Writer/Marketing' => 'Web Content Writer/Marketing'
        );

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::check() == false) {
            return redirect(route('login'));
        } else {
            $this->data['user'] = Auth::user();

            if (Auth::check() && Auth::user()->isAdmin) {
                return view('admin.adminhome')->with('data', $this->data);
            } else {
                return view('members.NotAuthorized');
            }
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function MemberDirectory()
    {
        $this->data['user'] = Auth::user();
        $this->data['users'] = DB::table('users')
            ->orderBy('lastname', 'ASC')
            ->get();

        foreach ($this->data['users'] as $k => $v) {
            $endingDate = Carbon::parse($v->lastpayment)->addYear(1);
            $today =  Carbon::now();
            $daysLeft = $endingDate->diffInDays($today);

            if ($daysLeft <= 0) {
                $remove[] = $k;
            }
        }
        if(isset($remove)) {
            foreach ($remove as $del) {
                unset($this->data['users'][$del]);
            }
        }
//dd($this->data);
        return view('admin.directory')->with('data', $this->data);
    }

    public function ExpiredMembers()
    {
        $this->data['user'] = Auth::user();
        $this->data['expiredUsers'] = User::all()->sortBy('lastname');

        $remove = [];
        foreach($this->data['expiredUsers'] as $k=>$v){
            $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($v->lastpayment))));
            $today = strtotime(date('Y-m-d'));
            $daysLeft = $endingDate - $today;
            $remaining = round((($daysLeft/ 24) / 60) / 60);
            if($remaining >= 1){
                $remove[]=$k;
            }
        }

        foreach($remove as $del){
            unset($this->data['expiredUsers'][$del]);
        }

        return view('admin.expireddirectory')->with('data', $this->data);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ShowMemberProfile($id)
    {

        $eventsAttended = DB::table('events')
            ->where('user_id', $id)->get();
        //dd($eventsAttended);
        $this->data['user'] = Auth::user();
        $this->data['member'] = $this->user->find($id);
        //get events user has registered for
        $this->data['member']['eventsAttendedNum'] = $this->getAttendedEventsCount($id);
        $this->data['member']['exp'] = Carbon::parse($this->data['member']->lastpayment)->addYear(1)->format('Y-m-d');

        $this->data['events'] = EventController::getEvents();

        $this->getAttendedEvents($eventsAttended); //array

        $this->data['member']['notes'] = $this->getMembersNotes($id);

        $this->data['timelines'] = $this->user->find($id)->timeline->toArray();
        $this->data['timelines']['user'] = $this->user->find($id);
        $this->data['userDaysLeft'] = $this->SubscriptionRemaining($id);
        $this->data['recent'] = $this->getUserRecentActivity($id);
        //dd($this->data['recent']);

        return view('admin.member_profile')->with('data', $this->data);
    }

    public function SubscriptionRemaining($id)
    {
        //days remaining calculation
        if($this->user->find($id)->lastpayment != null) {
            $endingDate = Carbon::parse($this->user->findorfail($id)->lastpayment)->addYear(1);
            $today =  Carbon::now();
            $daysLeft = $endingDate->diffInDays($today);
//dd($daysLeft);
            //dd($endingDate, $daysLeft);
            /*$year = new DateTime($this->user->findOrFail($id)->lastpayment);
            $currentYear = new DateTime('NOW');
            if($year->format('Y') > $currentYear->format('Y')){
                $endingDate = strtotime(date('Y-m-d', strtotime($this->user->find($id)->lastpayment)));
                dd('larger');
            }else{
                $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($this->user->find($id)->lastpayment))));
                dd('smaller');
            }
            $today = strtotime(date('Y-m-d'));
            $daysLeft = $endingDate - $today;*/

            //$DaysLeft = round((($daysLeft / 24) / 60) / 60);
            return $daysLeft;
        }else{
            return 0;
        }
    }

    public function getMembersNotes($id)
    {
        $notes = DB::table('notes')
            ->where('user_id', $id)
            ->value('notes');

        return $notes;
    }

    public function getAttendedEvents($ids)
    {
        $events = [];
        foreach($ids as $id){
            $events[] = $this->event->findorfail($id->event_id);
        }
        //dd($ids, $events);
        foreach($events as $event)
        {
            $this->data['attendedevents'][$event->ID] = [
                'date_start'     => $event->meta->date_start,
                'date_end'     => $event->meta->date_end,
                'time'      => $event->meta->event_time,
                'time_end'      => $event->meta->event_time_end,
                'name'      => $event->meta->event_name,
                'pricing'   => $event->meta->event_pricing,
                'event_content' => $this->stripContent($event->post_content),
                'event'     => $event,
                'attendies' => $this->getAttendees($event->ID),
            ];
        }
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function getAttendedEventsCount($id)
    {
        $events = count(DB::table('events')
            ->where('user_id', $id)->get());

        return $events;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEvents()
    {
        $this->data['user'] = Auth::user();
        $events = EventController::getEvents();
        $this->data['users'] = $this->user->all();

        $userids = [];
        foreach($events as $event)
        {
            $this->data['events'][$event->ID] = [
                'date_start'     => $event->meta->date_start,
                'date_end'     => $event->meta->date_end,
                'time'      => $event->meta->event_time,
                'time_end'      => $event->meta->event_time_end,
                'name'      => $event->meta->event_name,
                'pricing'   => $event->meta->event_pricing,
                'event_content' => $this->stripContent($event->post_content),
                'event'     => $event,
                'attendies' => $this->getAttendees($event->ID),
                'attendeeCount' => count($this->getAttendees($event->ID))
            ];
        }

        $this->OrganizeEvents($this->data['events']);

        return view('admin.events')->with('data', $this->data);
    }

    public function OrganizeEvents($eventlist)
    {
        foreach ($eventlist as $k=>$v){
            $d1 = new DateTime($v['date_start']);
            $d2 = new DateTime(date('Y-m-d'));
//dd($d2->diff($d1));
            if($d2->diff($d1)->invert == 1) {
                $this->data['events']['pastEvents'][$k] = $v;
            }else{
                $this->data['events']['futureEvents'][$k] = $v;
            }
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function MembersExpiring()
    {
        //set the currently Authenticated user
        $this->data['user'] = Auth::user();
//dd($this->data);
        $this->data['users'] = DB::table('users')
            ->whereYear('lastpayment', Carbon::parse('1 year ago'))
            ->whereMonth('lastpayment', date('m'))->get();

        //return view
        return view('admin.directory')->with('data', $this->data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function NewMembers()
    {
        //set the currently Authenticated user
        $this->data['user'] = Auth::user();

        $this->data['users'] = DB::table('users')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))->get();

        //return view
        return view('admin.directory')->with('data', $this->data);
    }
    public function RenewedMembers()
    {
        $this->data['user'] = Auth::user();

        $this->data['users'] = DB::table('users')
            ->whereYear('lastpayment', date('Y'))
            ->whereMonth('lastpayment', date('m'))->get();

        //return view
        return view('admin.directory')->with('data', $this->data);
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function CreateMember()
    {
        $this->data['user'] = Auth::user();

        return view('admin.addmember')->with('data', $this->data);
    }

    protected function validator($request){
        return Validator::make($request,[
            'firstname'         => 'required|min:3',
            'lastname'          => 'required|min:3',
            'username'          => 'required|min:3',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|min:6|confirmed',
            'cmg_position'      => 'required',
            'country'           => 'required',
            'state'             => 'required',
            'lastpayment'       => 'required',
        ]);
    }

    public function AddMemberValidator($request)
    {
        return Validator::make($request,[
            'firstname'     => 'required|min:3',
            'lastname'      => 'required|min:3',
            'username'      => 'required|unique:users,username|min:3',
            'email'         => 'required|email|unique:users,email',
            'company'       => 'required',
            'compweb'       => 'required|url',
            'industry'      => 'required',
            'prod'          => 'required',
            'city'          => 'required',
            'state'         => 'required',
            'zip'           => 'required',
            'phone'         => 'required',
            'address'       => 'required',
            'country'       => 'required',
            'cmg_position'  => 'required',
            'password'      => 'required|min:6|confirmed',
            'consumer'      => 'required_without:contract',
            'contract'      => 'required_without:consumer',
            'paymentdate'   => 'required|date'
        ]);
    }
    public function AddMember(Request $request)
    {
        $this->AddMemberValidator($request->toArray());

        if($request['activated'] && !$request['isadmin']){
            //dd('activated not admin');
            $user = $this->user->create([

                'firstname'         => $request->firstname,
                'lastname'          => $request->lastname,
                'username'          => $request->username,
                'email'             => $request->email,
                'hash'              => sha1($request->email),
                'password'          => bcrypt($request->password),
                'company'           => $request->company,
                'phone'             => $request->phone,
                'address'           => $request->address,
                'country'           => $request->country,
                'state'             => $request->state,
                'city'              => $request->city,
                'zip'               => $request->zip,
                'cmg_position'      => $request->cmg_position,
                'bio'               => $request->bio,
                'gravatar'          => '/storage/app/public/default_avatar.jpeg',
                'activated'         => 1,
                'deactivated'       => 0,
                'lastpayment'       => $request->lastpayment,
            ]);
        }
        elseif($request['activated'] && $request['isadmin']) {
            //dd('activated & admin');
            $user = $this->user->create([

                'firstname'         => $request->firstname,
                'lastname'          => $request->lastname,
                'username'          => $request->username,
                'email'             => $request->email,
                'hash'              => sha1($request->email),
                'password'          => bcrypt($request->password),
                'company'           => $request->company,
                'phone'             => $request->phone,
                'address'           => $request->address,
                'country'           => $request->country,
                'state'             => $request->state,
                'city'              => $request->city,
                'zip'               => $request->zip,
                'cmg_position'      => $request->cmg_position,
                'bio'               => $request->bio,
                'gravatar'          => '/storage/app/public/default_avatar.jpeg',
                'activated'         => 1,
                'isAdmin'           => 1,
                'deactivated'       => 0,
                'lastpayment'       => $request->lastpayment,
            ]);
        }elseif(!$request['activated'] && $request['isadmin']) {
            //dd('not activated & admin');
            $user = $this->user->create([

                'firstname'         => $request->firstname,
                'lastname'          => $request->lastname,
                'username'          => $request->username,
                'email'             => $request->email,
                'hash'              => sha1($request->email),
                'password'          => bcrypt($request->password),
                'company'           => $request->company,
                'phone'             => $request->phone,
                'address'           => $request->address,
                'country'           => $request->country,
                'state'             => $request->state,
                'city'              => $request->city,
                'zip'               => $request->zip,
                'cmg_position'      => $request->cmg_position,
                'bio'               => $request->bio,
                'gravatar'          => '/storage/app/public/default_avatar.jpeg',
                'activated'         => 1,
                'isAdmin'           => 1,
                'deactivated'       => 0,
                'lastpayment'       => $request->lastpayment,
            ]);
        }else{
            //dd('neither');
            $user = $this->user->create([

                'firstname'         => $request->firstname,
                'lastname'          => $request->lastname,
                'username'          => $request->username,
                'email'             => $request->email,
                'hash'              => sha1($request->email),
                'password'          => bcrypt($request->password),
                'company'           => $request->company,
                'phone'             => $request->phone,
                'address'           => $request->address,
                'country'           => $request->country,
                'state'             => $request->state,
                'city'              => $request->city,
                'zip'               => $request->zip,
                'cmg_position'      => $request->cmg_position,
                'bio'               => $request->bio,
                'gravatar'          => '/storage/app/public/default_avatar.jpeg',
                'activated'         => 0,
                'deactivated'       => 0,
                'lastpayment'       => $request->lastpayment,
            ]);
        }

        //if the user is created fire the event to send out an email so they can verify the account.
        if($user){
            event(new NewUser($user));
            event(new CompUser($user, $request['password']));
        }

        return back();
    }
    public function createCompany()
    {
        $this->data['user'] = Auth::user();
        return view('admin.companyadd')->with('data',$this->data);
    }

    public function addCompany(Request $request)
    {
        $this->validate($request,[
            'company_name'       => 'required|unique:companies,company_name',
            'compaddress'   => 'required',
            'compcity'      => 'required',
            'compstate'     => 'required',
            'compzip'       => 'required',
            'compphone'     => 'required',
            'companylevel'  => 'required',
        ]);
    //dd($request);
        if(isset($request['consumer'])) {
            $consumer = implode(',', $request['consumer']);
            $company = $this->company->create([
                'company_name' => $request['company_name'],
                'company_address' => $request['compaddress'],
                'phone' => $request['compphone'],
                'city' => $request['compcity'],
                'state' => $request['compstate'],
                'zip' => $request['compzip'],
                'fax' => $request['compfax'],
                'company_level' => $request->companylevel,
                'consumer' => $consumer,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }elseif(isset($request['contract'])) {
            $contract = implode(',', $request['contract']);
            $company = $this->company->create([
                'company_name' => $request['company_name'],
                'company_address' => $request['compaddress'],
                'phone' => $request['compphone'],
                'city' => $request['compcity'],
                'state' => $request['compstate'],
                'zip' => $request['compzip'],
                'fax' => $request['compfax'],
                'company_level' => $request->companylevel,
                'contract' => $contract,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return back();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function EditMember($id)
    {
        $user = new User;
        $this->data['user'] = Auth::user();
        $this->data['member'] = $user->findOrFail($id);
        $this->data['member']['member_level'] =
            DB::table('member_level')
                ->where('user_id', $id)
                ->value('member_level');

        $skills= DB::table('skills')->where('user_id', $id)->first();
        $this->data['member']['skills'] = ($skills) ? $skills->skills : '';

        $this->data['member']['exp'] = Carbon::parse($this->data['member']->lastpayment)->addYear(1)->format('Y-m-d');
        //dd($this->data['member']['exp']);
        return view('admin.edit')->with('data', $this->data);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function UpdateMember(Request $request, $id)
    {

        if(isset($request->isadmin)){
            $isAdmin = true;
        }else{
            $isAdmin = false;
        }
        if(isset($request->activated)){
            $activated = true;
        }else{
            $activated = false;
        }

        //set predetermined expiration date.
        $newLastpayemnt = Carbon::parse($request->expiration)->subYear(1)->format('Y-m-d');

        //set predetermined expiration date.
        $newLastpayemnt = Carbon::parse($request->expiration)->subYear(1)->format('Y-m-d');

        $to_update = [
                'firstname'   => $request->firstname,
                'lastname'   => $request->lastname,
                'isAdmin'   => $isAdmin,
                'activated'   => $activated,
                'username'  => $request->username,
                'company'   => $request->company,
                'email'  => $request->email,
                'address' => $request->address,
                'phone'  => $request->phone,
                'country'    => $request->country,
                'city'  => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'cmg_position' => $request->cmg_position,
                'bio' => $request->bio,
                'lastpayment' => $newLastpayemnt,
        ];

        if(isset($request->password)) {
            $to_update['password'] = \Hash::make($request->password);
        }

        try {
            DB::table('users')
                ->where('id', $id)
                ->update($to_update);
        
           DB::table('member_level')
                ->where('id', $id)
                ->update([
                    'member_level' => $request->member_level,
                    'updated_at' => Carbon::now(),
                ]);

           $skills = DB::table('skills')->where('user_id', $id)->first();

           if($skills){
               DB::table('skills')->where('user_id', $id)->update(
                   ['skills' => $request->skills]
               );
           } else {
               DB::table('skills')->insert(['user_id'=> $id, 'skills' => $request->skills]);
           }

        }catch (\Exception $e){
            session()->put('error', 'there was an error');
            return redirect('/admin/'.$id.'/edit');
        }

        session()->put('success', 'Member information updated.');
        return redirect('/admin/'.$id.'/edit');

    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function RemoveMember($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->delete();
        return redirect('/admin/directory');
    }

    /**
     * @param $content
     *
     * @return bool|mixed|string
     */
    public function stripContent($content)
    {
        $content = preg_replace('~\r\n~',' ', $content);
        $content = preg_replace("/(\[\w.*\])/imU", " ", $content);
        $content = preg_replace("/(\[\/\w.*\])/imU", " ", $content);
        $content = strip_tags($content);
        $content = trim($content);
        if(strlen($content) > 500){
            $contentcut = substr($content, 0, 500);
            $content = substr($contentcut, 0, strrpos($contentcut, ' '));
        }
        return $content;
    }

    public function AuthorizeList()
    {
        $this->data['user'] = Auth::user();
        $this->data['users'] = DB::table('users')
            ->where('isAcademic', 1)
            ->where('activated', 0)
            ->where('deactivated', 0)
            ->get();

        return view('admin.authorize')->with('data', $this->data);
    }

    public function AuthorizeUser($id)
    {
        $user = $this->user->findOrFail($id);
        event(new NewUser($user));

        return back();
    }
    /**
     * @return int
     */
    public function getTotalMemberInfo()
    {
        //get the total amount of current ACTIVE users.
        $activeMembers = User::all();


        foreach($activeMembers as $k=>$v){
            $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($v->lastpayment))));
            $today = strtotime(date('Y-m-d'));
            $daysLeft = $endingDate - $today;
            $remaining = round((($daysLeft / 24) / 60) / 60);
            if($remaining <= 0){
                $remove[]=$k;
            }
        }
        if(isset($remove)) {
            foreach ($remove as $del) {
                unset($activeMembers[$del]);
            }
        }

        //count the remainin members as ACTIVE
        $activeMembers = count($activeMembers);

        return $activeMembers;
    }

    /**
     * @return int
     */
    public function getExpiringAccounts()
    {
        return $expiring = DB::table('users')
            ->whereYear('lastpayment', Carbon::parse('1 year ago'))
            ->whereMonth('lastpayment', date('m'))->count();
    }

    public function getActiveAccounts()
    {
        return $expiring = User::whereActivated(1)
            ->where('deactivated', 0)
            ->whereYear('lastpayment', '>=', Carbon::parse('1 year ago'))
            ->where('limited_user', 0)->count();
    }

    /**
     * @return int
     */
    public function getMonthlyNewMembers()
    {
        return $newMembers = DB::table('users')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->where('limited_user', 0)->count();
    }

    public function getRenewedMembers()
    {
        return $renewed = DB::table('users')
            ->whereYear('lastpayment', date('Y'))
            ->whereMonth('lastpayment', date('m'))
            ->where('lastpayment', '!=', 'created_at')->count();
    }

    /**
     * @return mixed
     */
    public function getAttendees($id)
    {
        $eventUser = [];
        $eventUsers[$id] = DB::table('events')
            ->where('event_id', $id)
            ->get();
        foreach ($eventUsers as $k=>$v){
            if($k == $id){
                foreach($v as $things)
                $eventUser[] = $this->user->findOrFail($things->user_id);
            }
        }

        return $eventUser;
    }

    /**
     * @param $id
     */
    public function ExportCSV($id)
    {
        $eventName = $this->event->findOrFail($id)->meta->event_name;
        $eventUser = [];
        $eventUsers[$id] = DB::table('events')
            ->where('event_id', $id)
            ->get();
        foreach ($eventUsers as $k=>$v){
            if($k == $id){
                foreach($v as $things) {
                    $eventUser[] = $this->user->findOrFail($things->user_id);
                    $restrictions[] = DB::table('event_extra_info')->where('user_id', $things->user_id)->get()->first();
                }
            }
        }

        //create CSV
        $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());
        try{
            $csv->insertOne(Schema::getColumnListing('users'));
        }catch(CannotInsertRecord $exception) {
            session()->put('error', $exception);
        }catch(TypeError $exception){
            session()->put('error', $exception);
        }

        foreach ($eventUser as $user){
            $csv->insertOne($user->toArray());
        }
        $eventName = preg_replace('~\<(.*)\>~', ' ', $eventName);

        $csv->output($eventName.'-Attendee_List-'.date('Y-m-d').'.csv');
        //return redirect('adminhome');
    }

    public function Update(Request $request, $id)
    {
        //dd($request);
        //check if it exists
        $notes = null;
        $notes = DB::table('notes')
            ->where('user_id', $request->id)
            ->value('notes');

        if($notes == null) {
            DB::table('notes')
                ->insert([
                    'user_id' => $request->id,
                    'notes' => $request->notes
                ]);
        }else{
            DB::table('notes')
                ->where('user_id', $request->id)
                ->update([
                    'notes' => $request->notes
                ]);

        }
        if(isset($request['event'])){
            //add user to specified event
            //check to make sure there not already signed up and this is a mistake.
            $alreadyReged = DB::table('events')
                ->where('user_id', $request['user_id'])
                ->where('event_id', $request['event'])->get();
            //dd($request, count($alreadyReged));
            if(count($alreadyReged) <= 0){
                DB::table('events')
                    ->insert([
                        'event_id'      => $request['event'],
                        'user_id'       => $request['user_id'],
                        'amount_paid'   => $request['amount'],
                        'attendee_type' => $request['attendeeType'],
                        'payment_date'  => $request['paymentDate']
                    ]);
            }else{
                //dd('shit');
            }
        }

        return Redirect::to('/admin/profile/'.$id);
    }

    public function addMembertoEvent(Request $request)
    {
        $params = $request->all();
        array_shift($params);
        $eventID = $params['eventid'];
        array_shift($params);
//dd($params);
        for($i=0; $i <= count($params['user_id'])-1; $i++){
            DB::table('events')
                ->insert([
                    'event_id' => $eventID,
                    'user_id' => $params['user_id'][$i],
                    'amount_paid' => $params['amount_paid'][$i],
                    'attendee_type' => 'member',
                    'payment_date' => $params['payment_date'][$i],
                ]);
        }
        session()->put('success', 'Member has been created.');
        return back();
    }

    public function Extend(Request $request, $id)
    {

        if($this->user->findOrFail($id)->lastpayment == null){
            $currentEXPDate = Carbon::now();
        }else{
            $currentEXPDate = Carbon::parse($this->user->find($id)->lastpayment);
        }

        if(Carbon::parse($request->expiration) === $currentEXPDate->addYear(1)) {
            switch ($request->extend) {
                case '1W';
                    $newEXPDate = $currentEXPDate->addWeek(1);
                    break;
                case '2W';
                    $newEXPDate = $currentEXPDate->addWeek(2);
                    break;
                case '1M';
                    $newEXPDate = $currentEXPDate->addMonth(1);
                    break;
                case '3M';
                    $newEXPDate = $currentEXPDate->addMonth(3);
                    break;
                case '6M';
                    $newEXPDate = $currentEXPDate->addMonth(6);
                    break;
                case '1Y';
                    $newEXPDate = $currentEXPDate->addYear(1);
                    break;
            }
            DB::table('recentactivity')
                ->insert([
                    'user_id' => $id,
                    'activity' => 'Complimentary Membership Extension of ' . $request->extend . ', Your new expiration date is ' . $newEXPDate->format('Y-m-d'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        }else{
            $newEXPDate =Carbon::parse($request->expiration)->addYear(1);
            $newLPDate = Carbon::parse($request->expiration)->subYear(1);
            DB::table('recentactivity')
                ->insert([
                    'user_id' => $id,
                    'activity' => 'Complimentary Membership Extension, Your new expiration date is ' . $newEXPDate->format('Y-m-d'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        }
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'lastpayment' => $newLPDate->format('Y-m-d'),
                    'updated_at' => Carbon::now(),
                ]);



        return back();
    }

    public function DeactivateMember($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'deactivated' => 1,
            ]);

        return back();
    }

    public function ActivateMember($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'deactivated' => 0,
            ]);

        return back();
    }

    public function files()
    {
        $this->data['user'] = Auth::user();
        $this->data['files'] = MemberFiles::all();
        //dd($this->data['files']);
        return view('admin.files')->with('data', $this->data);
    }

    public function Upload()
    {
        $this->data['user'] = Auth::user();
        return view('admin.fileupload')->with('data', $this->data);
    }

    public function UploadFiles(Request $request)
    {
        //dd($request);
        $this->data['user'] = Auth::user();
        if($request->file()){
            //dd($request);
            $file = $request->file('fileInput');
            $filename = $file->getClientOriginalName();
            $mimeType = $file->getMimeType();
            //$path = '/uploads/images/'.Auth::id().'/'.date('Y').'/'.date('m').'/';
            //$fullPath = $path.$filename;

            $location = $file->storeAs('/memberfiles', $file->getClientOriginalName());
            //dd($location);


            $result = MemberFiles::create([
                'filename'          => $filename,
                'file_location'     => '/storage/app/' . $location,
                'file_type'         => $mimeType,
                'category'          => $request->category,
            ]);

            if($result->exists == true){
                return back();
            }else{
                return 'the file was uploaded but not saved to the database, please contact an administrator.';
            }
        }
        else{
            return 'there was an issue with uploading your file, please go back and try again.';
        }
    }

    public function Download($filename)
    {
        $path = storage_path('app') . '/memberfiles/'.$filename;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($path, $filename, $headers);
    }

    public function AccountControls($id, Request $request)
    {
        switch($request->buttontype){
            case 'activate';
                //change deactivated field to 0
                DB::table('users')
                    ->where('id', $id)
                    ->update(['deactivated' => 0]);
                break;
            case 'deactivate';
                //change deactivated field to 1
                DB::table('users')
                    ->where('id', $id)
                    ->update(['deactivated' => 1]);
                break;
            case 'terminate';
                //remove record.
                DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'lastpayment' => null,
                        'card_brand' => null,
                        'card_last_four' => null,
                        'paybycheck' => 0,
                        'isAcademic' => 0,
                        'academic_proof' => null,
                        'deactivated'   => 1,
                    ]);
                break;
        }
        return back();
    }
    public function AdvertUpload()
    {
        $this->data['user'] = Auth::user();
        $this->data['currentAdverts'] = DB::table('adverts')
            ->get()->all();
        return view('admin.profileadvert')->with('data', $this->data);
    }
    public function UploadAdvert(Request $request)
    {
        if(isset($request->advert_id) && $request->advert_id != null) {
            $removed = DB::table('adverts')
                        ->where('id', $request->advert_id)
                        ->delete();
            if($removed){
                session()->put('success', 'Advertisment has been removed.');
                return back();
            }
        }else{
            $this->validate($request, [
                'advertInput' => 'required|mimes:jpg,jpeg,gif',
                'advert_link' => 'required'
            ]);

            //dd($request);
            if ($request->file()) {
                $file = $request->file('advertInput');
                $filename = $file->getClientOriginalName();
                //$path = '/uploads/images/'.Auth::id().'/'.date('Y').'/'.date('m').'/';
                //$fullPath = $path.$filename;

                $location = $file->store('adverts');
                //dd($location);


                DB::table('adverts')->insert([
                    'advert_name' => $filename,
                    'advert_location' => '/storage/app/public/' . $location,
                    'advert_link' => $request->advert_link,
                ]);
                session()->put('success', 'Upload Successful!');
                return back();
            } else {
                session()->put('error', 'there was an issue with uploading your file, please go back and try again.');
                return back();
            }
        }
    }

    public function reemoveAdvert($id)
    {
        $removed = DB::table('adverts')-where('id', $id)->delete();

        if($removed){
            session()->put('success', 'Advertisment has been removed.');
            return back();
        }
    }

    public function ColorForecasts()
    {
        $this->data['user'] = Auth::user();

        return view('admin.colorforcast')->with('data',$this->data);
    }

    public function CreateColorForecasts(Request $request)
    {
        dd($request);
    }
    public function ShowReports()
    {
        $user = Auth::user();
        $this->data['user'] = $user;

        return view('admin.report')->with('data', $this->data);
    }

    public function reports(Request $request)
    {
        $user = Auth::user();
        $this->data['user'] = $user;

        $reportType = $request->reportType;
        $specificValue = $request->specific;
        $reports = [];

        switch ($reportType){
            case 'company';
                if($specificValue != null) {
                    $reports = User::whereCompany($specificValue)->orderBy('company', 'ASC')->get();
                }else{
                    $reports = User::all()->sortBy('company');
                }
                break;
            case 'expired';
                $reports = User::all()->where('limited_user', 0)->sortBy('lastname');

                $remove = [];
                foreach($reports as $k=>$v){
                    $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($v->lastpayment))));
                    $today = strtotime(date('Y-m-d'));
                    $daysLeft = $endingDate - $today;
                    $remaining = round((($daysLeft/ 24) / 60) / 60);
                    if($remaining >= 1){
                        $remove[]=$k;
                    }
                }
                foreach($remove as $del){
                    unset($reports[$del]);
                }
                break;
            case 'active';
                $reports = User::whereActivated(1)
                    ->where('deactivated', 0)
                    ->whereYear('lastpayment', '>', Carbon::parse('1 year ago'))
                    ->where('limited_user', 0)
                    ->get()
                    ->toArray();
                break;
            case 'newmonth';
                $reports = User::whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->where('limited_user', 0)
                    ->get()
                    ->toArray();
                break;
            case 'renewed';
                $reports = User::whereYear('lastpayment', date('Y'))
                    ->whereMonth('lastpayment', date('m'))
                    ->where('lastpayment', '!=', 'created_at')
                    ->where('limited_user', 0)
                    ->get()
                    ->toArray();
                break;
        }

        try{
            $csv = Writer::createFromFileObject(new \SplTempFileObject());
            $csv->insertOne(\Schema::getColumnListing('users'));
        }catch (Exception $e){
            session()->put('error', 'could not create file or insert a header. '.$e);
        }

        foreach($reports as $report){
            try{
                $csv->insertOne($report);
            }catch(Exception $exception){
                session()->put('error', 'there was an error creating the report '.$exception);
            }
        }
        $csv->output($reportType.'_report.csv');
    }

    public function showImport()
    {
        return view('admin.fileupload');
    }

    public function import(Request $request)
    {
        $file = $request['fileInput'];

        if($request->form == 'members') {
            $query = sprintf("LOAD DATA LOCAL INFILE '%s'
            INTO TABLE users
            FIELDS TERMINATED BY ','
            LINES TERMINATED BY '\r\n'
            (`firstname`,
            `lastname`,
            `username`,
            `cmg_position`,
            `company`,
            `position`,
            `gravatar`,
            `phone`,
            `email`,
            `address`,
            `country`,
            `city`,
            `state`,
            `zip`,
            `password`,
            `lastpayment`,
            `lastpaymentamount`,
            `created_at`,
            `activated`)", addslashes($file));

            return DB::connection()->getpdo()->exec($query);

        }elseif($request->form == 'companies') {
            $query = sprintf("LOAD DATA LOCAL INFILE '%s'
            INTO TABLE companies
            FIELDS TERMINATED BY ','
            LINES TERMINATED BY '\r\n'
            (`id`,
            `company_level`,
             `company_name`)", addslashes($file));

            return DB::connection()->getpdo()->exec($query);

        }elseif($request->form == 'company_members') {
            
            $arr = array(
                array(
                    'company_id' => 1,
                    'username' => 'JodySlingluff'),
                array(
                    'company_id' => 1,
                    'username' => 'DawnCornell'),
                array(
                    'company_id' => 2,
                    'username' => 'AudyMamertoMarcelo'),
                array(
                    'company_id' => 2,
                    'username' => 'SamerAlOmari'),
                array(
                    'company_id' => 3,
                    'username' => 'KevinRiley'),
                array(
                    'company_id' => 3,
                    'username' => 'RobertoParis'),
                array(
                    'company_id' => 4,
                    'username' => 'LindaCarroll'),
                array(
                    'company_id' => 4,
                    'username' => 'EliseFenwick'),
                array(
                    'company_id' => 4,
                    'username' => 'DoreenBecker'),
                array(
                    'company_id' => 5,
                    'username' => 'MitziMills'),
                array(
                    'company_id' => 5,
                    'username' => 'SarahTofan'),
                array(
                    'company_id' => 6,
                    'username' => 'KristinMoerman'),
                array(
                    'company_id' => 6,
                    'username' => 'JuliaKartush'),
                array(
                    'company_id' => 7,
                    'username' => 'JeanetteMcCuaig'),
                array(
                    'company_id' => 7,
                    'username' => 'RaziehCouncil'),
                array(
                    'company_id' => 8,
                    'username' => 'PhilipHoff'),
                array(
                    'company_id' => 8,
                    'username' => 'AngelKraemer'),
                array(
                    'company_id' => 9,
                    'username' => 'MarvinMiller'),
                array(
                    'company_id' => 9,
                    'username' => 'MoniqueHakkert'),
                array(
                    'company_id' => 10,
                    'username' => 'BrianChalmers'),
                array(
                    'company_id' => 10,
                    'username' => 'JulianeKruesemann'),
                array(
                    'company_id' => 10,
                    'username' => 'ZenonPaulCzornij'),
                array(
                    'company_id' => 11,
                    'username' => 'LindaBourgeois'),
                array(
                    'company_id' => 11,
                    'username' => 'BeverlyBell'),
                array(
                    'company_id' => 11,
                    'username' => 'LisaMeyer'),
                array(
                    'company_id' => 11,
                    'username' => 'DarrylAllen'),
                array(
                    'company_id' => 11,
                    'username' => 'RonnieMugford'),
                array(
                    'company_id' => 12,
                    'username' => 'ErikaWoelfel'),
                array(
                    'company_id' => 12,
                    'username' => 'QuinnLarson'),
                array(
                    'company_id' => 12,
                    'username' => 'DianaOlvera'),
                array(
                    'company_id' => 12,
                    'username' => 'RobynHellander'),
                array(
                    'company_id' => 13,
                    'username' => 'SharonGrech'),
                array(
                    'company_id' => 13,
                    'username' => 'SophieBergeron'),
                array(
                    'company_id' => 14,
                    'username' => 'EmilyIntrain'),
                array(
                    'company_id' => 14,
                    'username' => 'VeronicaDevon'),
                array(
                    'company_id' => 15,
                    'username' => 'ChristineSpencer'),
                array(
                    'company_id' => 15,
                    'username' => 'AllisonMeyer'),
                array(
                    'company_id' => 15,
                    'username' => 'MollyStronczek'),
                array(
                    'company_id' => 15,
                    'username' => 'DanielleHartmann'),
                array(
                    'company_id' => 15,
                    'username' => 'SueBritton'),
                array(
                    'company_id' => 16,
                    'username' => 'JuanitaGalliford'),
                array(
                    'company_id' => 16,
                    'username' => 'SandraMora'),
                array(
                    'company_id' => 16,
                    'username' => 'AmandaBauer'),
                array(
                    'company_id' => 17,
                    'username' => 'MaxineBurton'),
                array(
                    'company_id' => 18,
                    'username' => 'NickHarris'),
                array(
                    'company_id' => 18,
                    'username' => 'MaggieAmir'),
                array(
                    'company_id' => 18,
                    'username' => 'SusanLawson'),
                array(
                    'company_id' => 19,
                    'username' => 'TomHume'),
                array(
                    'company_id' => 19,
                    'username' => 'MeganAndretta'),
                array(
                    'company_id' => 20,
                    'username' => 'RichardCapel'),
                array(
                    'company_id' => 20,
                    'username' => 'CynthiaGreen'),
                array(
                    'company_id' => 21,
                    'username' => 'TeresaKummer'),
                array(
                    'company_id' => 21,
                    'username' => 'JessicaTang'),
                array(
                    'company_id' => 22,
                    'username' => 'StephanieDycha'),
                array(
                    'company_id' => 22,
                    'username' => 'NorzihanAziz'),
                array(
                    'company_id' => 23,
                    'username' => 'RachelSwan'),
                array(
                    'company_id' => 23,
                    'username' => 'DyleStoddard'),
                array(
                    'company_id' => 24,
                    'username' => 'CynthiaGapter'),
                array(
                    'company_id' => 24,
                    'username' => 'PeterVonTrampe'),
                array(
                    'company_id' => 25,
                    'username' => 'JohnFitzgerald'),
                array(
                    'company_id' => 25,
                    'username' => 'MichaelDAgnese'),
                array(
                    'company_id' => 26,
                    'username' => 'JulieStark'),
                array(
                    'company_id' => 26,
                    'username' => 'GregLedesma'),
                array(
                    'company_id' => 27,
                    'username' => 'MikealJensen'),
                array(
                    'company_id' => 27,
                    'username' => 'TerriMarrion'),
                array(
                    'company_id' => 28,
                    'username' => 'MichelleBolchune'),
                array(
                    'company_id' => 28,
                    'username' => 'GailPeterson'),
                array(
                    'company_id' => 29,
                    'username' => 'KathrineWisniski'),
                array(
                    'company_id' => 29,
                    'username' => 'AmyDarding'),
                array(
                    'company_id' => 29,
                    'username' => 'EmilyModezjewski'),
                array(
                    'company_id' => 29,
                    'username' => 'JillNelson'),
                array(
                    'company_id' => 30,
                    'username' => 'SuzetteMorris'),
                array(
                    'company_id' => 30,
                    'username' => 'ShellyHalbert'),
                array(
                    'company_id' => 30,
                    'username' => 'SarahMorales'),
                array(
                    'company_id' => 30,
                    'username' => 'KarenSigrist'),
                array(
                    'company_id' => 31,
                    'username' => 'LloydVliet'),
                array(
                    'company_id' => 31,
                    'username' => 'DianeGeisler'),
                array(
                    'company_id' => 31,
                    'username' => 'QianEschbach'),
                array(
                    'company_id' => 31,
                    'username' => 'SusanBunting'),
                array(
                    'company_id' => 31,
                    'username' => 'JeffWatts'),
                array(
                    'company_id' => 31,
                    'username' => 'DustinBowersox'),
                array(
                    'company_id' => 31,
                    'username' => 'KenBotts'),
                array(
                    'company_id' => 31,
                    'username' => 'CherylJohnston'),
                array(
                    'company_id' => 31,
                    'username' => 'ThomasLaTempa'),
                array(
                    'company_id' => 32,
                    'username' => 'DennisMueller'),
                array(
                    'company_id' => 32,
                    'username' => 'MarkusOrthey'),
                array(
                    'company_id' => 33,
                    'username' => 'JoeJasinski'),
                array(
                    'company_id' => 33,
                    'username' => 'NicolaHoneycutt'),
                array(
                    'company_id' => 34,
                    'username' => 'ClaudiaLampert'),
                array(
                    'company_id' => 34,
                    'username' => 'SheenaTasich'),
                array(
                    'company_id' => 35,
                    'username' => 'HallDillonII'),
                array(
                    'company_id' => 35,
                    'username' => 'EmilyMcEwen'),
                array(
                    'company_id' => 36,
                    'username' => 'DeiseMarchezanodeMelo'),
                array(
                    'company_id' => 37,
                    'username' => 'VictoriaRaines'),
                array(
                    'company_id' => 37,
                    'username' => 'StacyAvedisian'),
                array(
                    'company_id' => 38,
                    'username' => 'SeanCilona'),
                array(
                    'company_id' => 38,
                    'username' => 'MarilenaVergnani'),
                array(
                    'company_id' => 39,
                    'username' => 'ReneeHytryDerrington'),
                array(
                    'company_id' => 39,
                    'username' => 'AngelaLin'),
                array(
                    'company_id' => 39,
                    'username' => 'MeganMcClendon'),
                array(
                    'company_id' => 40,
                    'username' => 'ReneeHytryDerrington'),
                array(
                    'company_id' => 40,
                    'username' => 'AngelaLin'),
                array(
                    'company_id' => 40,
                    'username' => 'MeganMcClendon'),
                array(
                    'company_id' => 41,
                    'username' => 'MarciaBlake'),
                array(
                    'company_id' => 41,
                    'username' => 'AmyRochester'),
                array(
                    'company_id' => 41,
                    'username' => 'MelanieBernard'),
                array(
                    'company_id' => 42,
                    'username' => 'TimLeese'),
                array(
                    'company_id' => 42,
                    'username' => 'DeniseSmith'),
                array(
                    'company_id' => 43,
                    'username' => 'MarthaWilliams'),
                array(
                    'company_id' => 43,
                    'username' => 'LeeAnnHarmening'),
                array(
                    'company_id' => 44,
                    'username' => 'BrianBacin'),
                array(
                    'company_id' => 44,
                    'username' => 'ErinRiddle'),
                array(
                    'company_id' => 45,
                    'username' => 'SabineGriesbeck'),
                array(
                    'company_id' => 45,
                    'username' => 'MareikeHofner-Voll'),
                array(
                    'company_id' => 46,
                    'username' => 'LindaBourgeois'),
                array(
                    'company_id' => 46,
                    'username' => 'BeverlyBell'),
                array(
                    'company_id' => 46,
                    'username' => 'LisaMeyer'),
                array(
                    'company_id' => 46,
                    'username' => 'DarrylAllen'),
                array(
                    'company_id' => 46,
                    'username' => 'RonnieMugford'),
                array(
                    'company_id' => 47,
                    'username' => 'LindaBourgeois'),
                array(
                    'company_id' => 47,
                    'username' => 'BeverlyBell'),
                array(
                    'company_id' => 47,
                    'username' => 'LisaMeyer'),
                array(
                    'company_id' => 47,
                    'username' => 'DarrylAllen'),
                array(
                    'company_id' => 47,
                    'username' => 'RonnieMugford'),
                array(
                    'company_id' => 48,
                    'username' => 'ChrisDillion'),
                array(
                    'company_id' => 48,
                    'username' => 'JimDennis'),
                array(
                    'company_id' => 49,
                    'username' => 'DanieleMartin'),
                array(
                    'company_id' => 50,
                    'username' => 'MarkAlan'),
                array(
                    'company_id' => 51,
                    'username' => 'PamelaLee'),
                array(
                    'company_id' => 51,
                    'username' => 'ErinAmbrose'),
                array(
                    'company_id' => 52,
                    'username' => 'TressaSamdal'),
                array(
                    'company_id' => 52,
                    'username' => 'SarahGist'),
                array(
                    'company_id' => 53,
                    'username' => 'GingerGilbert'),
                array(
                    'company_id' => 53,
                    'username' => 'DeniseBennett'),
                array(
                    'company_id' => 54,
                    'username' => 'EmilyLueken'),
                array(
                    'company_id' => 54,
                    'username' => 'KrystleSmith'),
                array(
                    'company_id' => 55,
                    'username' => 'SamanthaBaker'),
                array(
                    'company_id' => 55,
                    'username' => 'RebeccaWynne'),
                array(
                    'company_id' => 55,
                    'username' => 'AnnetteCallari'),
                array(
                    'company_id' => 56,
                    'username' => 'MaryLawlor'),
                array(
                    'company_id' => 56,
                    'username' => 'AprilHaffer'),
                array(
                    'company_id' => 57,
                    'username' => 'PatriciaWagner'),
                array(
                    'company_id' => 57,
                    'username' => 'SallyCurtis'),
                array(
                    'company_id' => 57,
                    'username' => 'DominicIudiciani'),
                array(
                    'company_id' => 58,
                    'username' => 'MollyBasile'),
                array(
                    'company_id' => 58,
                    'username' => 'KristinMancia'),
                array(
                    'company_id' => 59,
                    'username' => 'StephanieAdams'),
                array(
                    'company_id' => 60,
                    'username' => 'ShawnaLeMott'),
                array(
                    'company_id' => 61,
                    'username' => 'DanTwaddell'),
                array(
                    'company_id' => 62,
                    'username' => 'JosephAmato'),
                array(
                    'company_id' => 62,
                    'username' => 'TerryMarchetta'),
                array(
                    'company_id' => 63,
                    'username' => 'SarahReep'),
                array(
                    'company_id' => 63,
                    'username' => 'BonnieSchmitz'),
                array(
                    'company_id' => 64,
                    'username' => 'StephaniePierce'),
                array(
                    'company_id' => 64,
                    'username' => 'SandraLuttchens'),
                array(
                    'company_id' => 64,
                    'username' => 'KatieKuiper'),
                array(
                    'company_id' => 65,
                    'username' => 'BrittanyStanley'),
                array(
                    'company_id' => 65,
                    'username' => 'MorganPreston'),
                array(
                    'company_id' => 66,
                    'username' => 'MelissaSjerven'),
                array(
                    'company_id' => 66,
                    'username' => 'EmilyLaPointe'),
                array(
                    'company_id' => 67,
                    'username' => 'CarolineHipple'),
                array(
                    'company_id' => 67,
                    'username' => 'DixonBartlett'),
                array(
                    'company_id' => 68,
                    'username' => 'JaneSuchla'),
                array(
                    'company_id' => 68,
                    'username' => 'SusanBeiser'),
                array(
                    'company_id' => 68,
                    'username' => 'KarenPalumbo'),
                array(
                    'company_id' => 69,
                    'username' => 'PatBilotto'),
                array(
                    'company_id' => 69,
                    'username' => 'DebbieSulewski'),
                array(
                    'company_id' => 69,
                    'username' => 'WendyEymez'),
                array(
                    'company_id' => 70,
                    'username' => 'KarenDanner'),
                array(
                    'company_id' => 70,
                    'username' => 'BobKaminski'),
                array(
                    'company_id' => 70,
                    'username' => 'PhillipRiccardi'),
                array(
                    'company_id' => 71,
                    'username' => 'NancyAdkins'),
                array(
                    'company_id' => 71,
                    'username' => 'TraceyLachapelle-Deasy'),
                array(
                    'company_id' => 72,
                    'username' => 'BobHurley'),
                array(
                    'company_id' => 72,
                    'username' => 'BlairCrockett'),
                array(
                    'company_id' => 73,
                    'username' => 'AngelaNuessle'),
                array(
                    'company_id' => 73,
                    'username' => 'ChelseaHenderson'),
                array(
                    'company_id' => 73,
                    'username' => 'MelaniePearsall'),
                array(
                    'company_id' => 74,
                    'username' => 'MarkusFrentrop'),
                array(
                    'company_id' => 74,
                    'username' => 'MelanieZitzke'),
                array(
                    'company_id' => 74,
                    'username' => 'YangYang'),
                array(
                    'company_id' => 75,
                    'username' => 'ShannonMcMahon'),
                array(
                    'company_id' => 75,
                    'username' => 'MadelineFreding'),
                array(
                    'company_id' => 76,
                    'username' => 'MonikaHaag'),
                array(
                    'company_id' => 76,
                    'username' => 'VerenaBecker'),
                array(
                    'company_id' => 77,
                    'username' => 'LauraWilliams'),
                array(
                    'company_id' => 77,
                    'username' => 'SarahSurace'),
                array(
                    'company_id' => 78,
                    'username' => 'LauraWilliams'),
                array(
                    'company_id' => 78,
                    'username' => 'SarahSurace'),
                array(
                    'company_id' => 79,
                    'username' => 'DeannaBrickner'),
                array(
                    'company_id' => 79,
                    'username' => 'HaleyHeupel'),
                array(
                    'company_id' => 79,
                    'username' => 'BethSteele'),
                array(
                    'company_id' => 80,
                    'username' => 'AlexandraDavis'),
                array(
                    'company_id' => 80,
                    'username' => 'JenniferMiller'),
                array(
                    'company_id' => 81,
                    'username' => 'AshleyODonnell'),
                array(
                    'company_id' => 81,
                    'username' => 'LauraQuille'),
                array(
                    'company_id' => 81,
                    'username' => 'LupeLara'),
                array(
                    'company_id' => 81,
                    'username' => 'MeganNewton'),
                array(
                    'company_id' => 81,
                    'username' => 'MarkWilgen'),
                array(
                    'company_id' => 81,
                    'username' => 'ChristinaRozwadowski'),
                array(
                    'company_id' => 82,
                    'username' => 'GeorgeIannuzzi'),
                array(
                    'company_id' => 83,
                    'username' => 'MichaelDeimen'),
                array(
                    'company_id' => 83,
                    'username' => 'AlexanderLambright'),
                array(
                    'company_id' => 83,
                    'username' => 'JoelAlberda'),
                array(
                    'company_id' => 83,
                    'username' => 'KimberlySank'),
                array(
                    'company_id' => 84,
                    'username' => 'StephanieRichardson'),
                array(
                    'company_id' => 85,
                    'username' => 'AngkanaKreeratiratanalak'),
                array(
                    'company_id' => 85,
                    'username' => 'DrFrankJMaile'),
                array(
                    'company_id' => 86,
                    'username' => 'LisaMyers'),
                array(
                    'company_id' => 86,
                    'username' => 'LoriSeykor'),
                array(
                    'company_id' => 87,
                    'username' => 'ElizabethWolff'),
                array(
                    'company_id' => 87,
                    'username' => 'JohnJoyce'),
                array(
                    'company_id' => 88,
                    'username' => 'TheresaMead'),
                array(
                    'company_id' => 89,
                    'username' => 'StacyGarcia'),
                array(
                    'company_id' => 90,
                    'username' => 'NicoleRiedel'),
                array(
                    'company_id' => 91,
                    'username' => 'SusieDarrah'),
                array(
                    'company_id' => 91,
                    'username' => 'ChelsieHerman'),
                array(
                    'company_id' => 92,
                    'username' => 'TraciKloos'),
                array(
                    'company_id' => 92,
                    'username' => 'KateThompson'),
                array(
                    'company_id' => 93,
                    'username' => 'DoreenBeyer'),
                array(
                    'company_id' => 93,
                    'username' => 'MargieDrechsel'),
                array(
                    'company_id' => 94,
                    'username' => 'MichaelPlank'),
                array(
                    'company_id' => 94,
                    'username' => 'KarrieHodge'),
                array(
                    'company_id' => 95,
                    'username' => 'PatriciaFeccideCarvalhoTeixeira'),
                array(
                    'company_id' => 95,
                    'username' => 'ErikaMenezes'),
                array(
                    'company_id' => 95,
                    'username' => 'MariaJoseCaleroCruzCruz'),
                array(
                    'company_id' => 96,
                    'username' => 'RickMontoya'),
                array(
                    'company_id' => 96,
                    'username' => 'AmberPoston'),
                array(
                    'company_id' => 97,
                    'username' => 'YasuakiOkita'),
                array(
                    'company_id' => 98,
                    'username' => 'JanisShard'),
                array(
                    'company_id' => 98,
                    'username' => 'KellyHyde'),
                array(
                    'company_id' => 98,
                    'username' => 'VictoriaPoggetto'),
                array(
                    'company_id' => 99,
                    'username' => 'JanisShard'),
                array(
                    'company_id' => 99,
                    'username' => 'KellyHyde'),
                array(
                    'company_id' => 99,
                    'username' => 'VictoriaPoggetto'),
                array(
                    'company_id' => 100,
                    'username' => 'LizVermoesen'),
                array(
                    'company_id' => 100,
                    'username' => 'LaurenHege'),
                array(
                    'company_id' => 101,
                    'username' => 'WinstonKoo'),
                array(
                    'company_id' => 101,
                    'username' => 'AlickKoo'),
                array(
                    'company_id' => 102,
                    'username' => 'TracyPhillips'),
                array(
                    'company_id' => 102,
                    'username' => 'DanielaKolodziej'),
                array(
                    'company_id' => 103,
                    'username' => 'GregCompton'),
                array(
                    'company_id' => 103,
                    'username' => 'GeorgeYu'),
                array(
                    'company_id' => 104,
                    'username' => 'KayleeWheeler'),
                array(
                    'company_id' => 104,
                    'username' => 'AnneMalec'),
                array(
                    'company_id' => 105,
                    'username' => 'ColleenMeyers'),
                array(
                    'company_id' => 105,
                    'username' => 'KatieColeman'),
                array(
                    'company_id' => 106,
                    'username' => 'HollyShirley')
            );
    
            foreach($arr as $item) {
                $userinfo = $this->user->where('username', $item[ 'username' ])->get()->first();
                
                if($userinfo != null){
                    $userid = $userinfo->id;
                    $compadmin = $userinfo->companyAdmin;
                    
                    DB::table('company_members')
                        ->insert([
                            'company_id' => $item['company_id'],
                            'user_id' => $userid,
                        ]);
                }
    
            }
        }
    }

    public function getUserRecentActivity($id)
    {
        $recents = DB::table('recentactivity')
            ->where('user_id', $id)
            ->get();

        $date = [];
        foreach($recents as $recent){
            //dd($recent);
            $activity['msg'][] = $recent->activity;
            $datetime[] = preg_split('~ ~',$recent->created_at);
        }
        if(isset($datetime[1])) {

            foreach ($datetime as $date) {
                $dates = preg_split('~-~', $date[0]);
                //dd($dates);
                $finaldate['y'][] = $dates[0];
                $finaldate['m'][] = $dates[1];
                $finaldate['d'][] = $dates[2];
            }

            for ($i = 0; $i <= count($finaldate['y']) - 1; $i++) {
                $activity['date'][] = Carbon::create($finaldate['y'][$i], $finaldate['m'][$i], $finaldate['d'][$i], 0)->format('D, M d Y');
            }
        }

        if(isset($activity)){
            return $activity;
        }else{
            return '';
        }
    }
}
