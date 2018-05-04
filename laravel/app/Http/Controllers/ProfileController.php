<?php

namespace App\Http\Controllers;

use App\Event;
use App\Events\CompUser;
use App\Events\NewUser;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Comments;
use Illuminate\Http\Request;
use App\Events\AccountExpiration;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{

    public $data;
    public $user;

    /**
     * MembersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->data = [

        ];
        $this->user = new User;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @param $username
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create($username)
    {
        //

        if(Auth::user()->username == $username){
            return Redirect::to('/profile');
        }

        if(!$member = DB::table('users')->where('username', $username)->first())
        {
            return redirect('NotAuthorized');
        }


        $this->data = [
            'user' => Auth::user(),
            'member' => DB::table('users')->where('username', $username)->first(),
            'followers' => $this->getFollowers($member->id),
            'following' => $this->getFollowing($member->id),
            'skills' => $this->getSkills($member->id),
            //'followWho' => $this->getWhoToFollow(),
            'userDaysLeft' => $this->SubscriptionRemaining(Auth::id()),
            'memberTimelines' => $this->user->find($member->id)->timeline->sortBy('ASC'),
            'advert' => $this->RandomAdvert(),
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
//dd(Carbon::parse('D, M d Y', $this->data['member']->created_at));
        return view('members.profile.memberprofile')->with('data', $this->data);
    }



    public function jsonUsers()
    {
        return DB::table('users')->get()->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {

        if (Auth::user()->isAcademic == 1 && Auth::user()->academic_proof == null) {

            return redirect('/academic-upload');
        }
        //loop through and get user object for each follower
        $followTimelineData = [];

        if (Auth::user()->followers) {
            foreach (Auth::user()->followers as $follower) {
                //get who the user is following authed user will be in collumn follower_id
                if ($this->user->where('id', $follower->id)->count() > 0) {
                    $followTimelineData[] = $this->user->find($follower->follower_id)->timeline->toArray();
                }
            }
        }

        $this->data = [
            'user' => Auth::user(),
            'users' => $this->user->all(),
            'followWho' => $this->getWhoToFollow(),
            'followerList' => $this->getFollowerList(Auth::id()),
            'numFollowers' => $this->getFollowers(Auth::id()),
            'followingList' => $this->getFollowingList(Auth::id()),
            'numFollowing' => $this->getFollowing(Auth::id()),
            'userDaysLeft' => $this->SubscriptionRemaining(Auth::id()),
            'diet' => $this->getDietRestrictions(Auth::id()),
            'dueDate' => $this->CalcDueDate($this->SubscriptionRemaining(Auth::id())),
            'recent' => $this->getRecentActivity(Auth::id()),
            'skills' => $this->getSkills(Auth::id()),
            'skills_edit' => implode(',', $this->getSkills(Auth::id())),
            'timelines' => $this->SetupTimeline($followTimelineData),
            'advert' => $this->RandomAdvert(),
            'countryvalue' => Auth::user()->country,
            'statevalue' => Auth::user()->state,
            'industryvalue' => Auth::user()->industry,
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
        //dd($this->data['user']->state);
        foreach($this->data['states'] as $k=>$v){
            if($k == $this->data['user']->state){
                $this->data['user']->state = $v;
                $this->data['user']->stateabv = $k;
                $this->data['user']->stateabv = 'select a State';
            }else{
            }
        }
        foreach($this->data['country'] as $k=>$v){
            if($k == $this->data['user']->country){
                $this->data['user']->country = $v;
                $this->data['user']->countryabv = $k;
            }else{
                $this->data['user']->countryabv = 'select a Country';
            }
        }

        if(Auth::user()->companyAdmin == 1){
            $companyID = DB::table('company_members')
                ->where('user_id', Auth::user()->id)
                ->value('company_id');

            $userIDS = DB::table('company_members')
                ->where('company_id', $companyID)
                ->get()
                ->all();
            $this->data['companyInfo'] = DB::table('companies')
                ->where('id', $companyID)
                ->first();

            foreach($this->data['states'] as $k=>$v) {
                if (isset($k) && isset($this->data['companyInfo']->state)){
                    if ($k == $this->data['companyInfo']->state) {
                        $this->data['companyInfo']->state = $v;
                        $this->data['companyInfo']->stateabv = $k;
                    }else{
                        $this->data['companyInfo']->stateabv = 'select a State';
                    }
                }
            }

            foreach($this->data['country'] as $k=>$v){
                //dd($k, $this->data['companyInfo']->country);
                if(isset($k) && isset($this->data['companyInfo']->country)) {
                    if ($k === $this->data['companyInfo']->country) {
                        $this->data['companyInfo']->country = $v;
                        $this->data['companyInfo']->countryabv = $k;
                    } else {
                        $this->data['companyInfo']->countryabv = 'select a Country';
                    }
                }
            }
            //dd($this->data['companyInfo']->countryabv);

            foreach($userIDS as $userid){
                $this->data['companymembers'][] = $this->user->findOrFail($userid->user_id);
            }
            //dd($this->data['companymembers']);
        }

        if(Auth::user()->companyAdmin){
            $consumer = DB::table('companies')
                ->where('company_name', Auth::user()->company)
                ->value('consumer');
            $contract = DB::table('companies')
                ->where('company_name', Auth::user()->company)
                ->value('contract');
            $this->data['consumer'] = explode(',', $consumer);
            $this->data['contract'] = explode(',', $contract);
        }

        return view('members.profile.profile')->with('data', $this->data);
    }

    public function getRecentActivity($id)
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
        if(isset($datetime)) {
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

    public static function getEvents()
    {
        return $events = Event::type('event')->status('publish')->get();
    }

    public function CalcDueDate($remaining){
        if($remaining > 0) {

            $current = new Carbon();
            $today = Carbon::today();

            $dueDate = $current->addDays($remaining)->format('D, M d Y');

            return $dueDate;
        }
        else{
            return 'Not Active';
        }
    }
    public function getSkills($id)
    {
        //$skills = DB::table('users')->where('id', $id)->value('skills');
        $skills = DB::table('skills')->where('user_id', $id)->value('skills');
        $skills = explode(',',$skills);
        return $skills;
    }

    public function SkillsPopup($skills)
    {
        /*foreach ($skills as $skill){
            $usersWithskill = DB::table('users')
                ->whereIn('skills', $skill)
                ->get();
        }
        return $usersWithskill;*/
    }

    public function SetupTimeline($followTimelineData)
    {
        //get timeline posts --> users and followers

        $timelines = Auth::user()->timeline->toArray();
        //dd();
        //dd($timelines);
        foreach ($followTimelineData as $data) {
            $timelines = array_merge($timelines, $data);
        }

        array_multisort($timelines, SORT_DESC);

        //dd(Auth::user()->comments->toarray());

        //add user data to each array
        $i =0;
        //dd($timelines);
        foreach($timelines as $post)
        {
            $timelines[$i]['user'] = $this->user->find($post['user_id']);
            $timelines[$i]['date'] = $post['created_at'];
            $timelines[$i]['comments'] = Comments::wheretimeline_id($post['id'])->get()->toarray();
            $i++;
        }
        //dd($timelines);
        //dd($timelines, Auth::user()->timeline[1]->created_at);
        return $timelines;
    }

    public function SubscriptionRemaining($id)
    {
        //days remaining calculation
        if($this->user->find($id)->lastpayment != null) {
            $endingDate = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($this->user->find($id)->lastpayment))));
            $today = strtotime(date('Y-m-d'));
            $daysLeft = $endingDate - $today;

            $DaysLeft = round((($daysLeft / 24) / 60) / 60);

            /*if($DaysLeft == 30){
                event(new AccountExpiration(Auth::user(),$DaysLeft));
            }elseif($DaysLeft == 15){
                event(new AccountExpiration(Auth::user(),$DaysLeft));
            }elseif($DaysLeft <= 3){
                event(new AccountExpiration(Auth::user(),$DaysLeft));
            }*/

            return $DaysLeft;
        }else{
            session()->put('error', 'Registration is required, for certain actions on this site.');
            return 0;
        }
    }
    public function getWhoToFollow()
    {
        $ignorelist = [];

        $following = self::getFollowingList(Auth::id());

        if(count($following) >= 1) {
            foreach ($following as $follower) {
                if(isset($follower->id)) {
                    $ignorelist[] = $follower->id;
                }
            }
            //add self to ignore list.
            array_push($ignorelist, Auth::id());

            $user = $this->user->find(Auth::id());

            if (isset($user->industry)) {
                $randomFollow = $this->user->all()
                    ->where('industry', $user->industry)
                    ->where('activated', 1)
                    ->where('deactivated', 0)
                    ->whereNotIn('id', $ignorelist);

            } else {
                $randomFollow = $user->all()
                    ->where('activated', 1)
                    ->where('deactivated', 0)
                    ->WhereNotIn('id', $ignorelist);

            }
            //dd($user->industry, $ignorelist, $randomFollow);
            if (count($randomFollow) == 0) {
                $randomFollow = 'There are no other members in your industry.';
            }
            return $randomFollow;
        }
    }

    public function getFollowers($id)
    {
        //get follow records from DB
        $followers = DB::table('follows')->where('follower_id', $id)->get();
        $followers = count($followers);

        return $followers;
    }
    public function getFollowerList($id)
    {
        $followerList = array();

        $ids = DB::table('follows')->select('user_id')->where('follower_id', $id)->get();

        if(count($ids) <= 0){
            $followerList = ['Sorry, No one is Following.'];
        }else{
            foreach($ids as $user_id){
                $followerList[] = $this->user->findOrFail($user_id->user_id);
            }
        }

        return $followerList;

    }
    public function getFollowing($id)
    {
        //get follow records from DB
        $following = DB::table('follows')->where('user_id', $id)->get();
        $following = count($following);

        return $following;
    }
    public function getFollowingList($id)
    {
        $followingList = array();

        $ids = DB::table('follows')->select('follower_id')->where('user_id', $id)->get();
        if(count($ids) <= 0){
            $followingList = ['Sorry, You have not followed anyone.'];
        }else{
            foreach($ids as $follower_id){
                //check if the person being followed exists if not remove htem.
                if ($this->user->where('id', $follower_id->follower_id)->exists()) {
                    $followingList[] = $this->user->findOrFail($follower_id->follower_id);
                }else{
                    DB::table('follows')
                        ->where('follower_id', $follower_id->follower_id)
                        ->delete();
                }
            }
        }
        //dd($followingList);
        return $followingList;
    }

    public function getDietRestrictions($id)
    {
        $diet = DB::table('event_extra_info')
            ->where('user_id', $id)
            ->get()->first();

        return $diet;
    }

    public function dateTimeFix($input)
    {
        $output = preg_split('~\s+~',$input);
        //dd($output);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function genupdate(Request $request, $id) {
        $saved = false;
        $validation = false;

        //dd($request->file('avatarInput')->getClientOriginalExtension(), $request->file('avatarInput')->getSize(), $request->file('avatarInput')->getClientSize() / 1024);

       if($request->file('avatarInput')->getMimeType() == 'image/jpeg' || $request->file('avatarInput')->getMimeType() == 'image/gif'){
           $validation = true;
       }
        if(!$validation){
            session()->put('error', 'Your Must Submit a file, and you may only Upload jpeg\'s or gif\'s');
            return back()->with(['tab'=>'general']);
        }

        if($request->file()){
            $file = $request->file('avatarInput');
            if($file->getClientSize() / 1024 > 5000)
            {
                session()->put('error', 'The file you selected is too large to upload.');
                return back()->with(['tab'=>'general']);
            }
            $location = $file->store(Auth::id().'/avatar');

            $saved = DB::table('users')
                ->where('id', $id)
                ->update([
                    'gravatar' => '/storage/app/public/'.$location,
                ]);
        }
        if($saved) {
            session()->put('success', 'You\'re Avatar has been saved.');
            return back()->with(['tab'=>'general']);
        }else{
            session()->put('error', 'You\'re avatar was not saved.');
            return back()->with(['tab'=>'general']);
        }
    }

    /**
     * change password
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->id != $id) {
            session()->put('error', 'Your Password was not saved.');
            return back()->with(['tab'=>'general']);
        }

        $password = \Hash::make($request->password);
        $user->password = $password;
        $user->save();

        session()->put('success', 'Your Password has been saved.');
        return back()->with(['tab'=>'general']);

    }

    public function check_unique(Request $request) {
        $id = $request->id;
        $arr_validator_condition = Array();
        if (isset($request->linkedin) && $request->linkedin != "") {
            $arr_validator_condition['linkedin'] = 'unique:users,linkedin,'.$id;
        }
        if (isset($request->twitter) && $request->twitter != "") {
            $arr_validator_condition['twitter'] = 'unique:users,twitter,'.$id;
        }
        if (isset($request->facebook) && $request->facebook != "") {
            $arr_validator_condition['facebook'] = 'unique:users,facebook,'.$id;
        }
        if (isset($request->instagram) && $request->instagram != "") {
            $arr_validator_condition['instagram'] = 'unique:users,instagram,'.$id;
        }
        $validator = \Validator::make($request->all(), $arr_validator_condition);

        if ($validator->passes()) {
            return response()->json([
                'success' => true,
                'message' => 'record updated'
            ], 200);
        }

        $errors = $validator->errors();
        $errors =  json_decode($errors);

        return response()->json([
            'success' => false,
            'message' => $errors
        ], 422);

        /* $is_valid = true;
        if ($validator->fails()) {
            $is_valid = false;
        }
        if($is_valid) {
            return json_encode(array('status'=>1));
        } else {
            return json_encode(array('status'=>0));
        } */
    }

    public function contactupdate(Request $request, $id)
    {

        $arr_validator_condition = Array();
        if (isset($request->linkedin) && $request->linkedin != "") {
            $arr_validator_condition['linkedin'] = 'unique:users,linkedin';
        }
        if (isset($request->twitter) && $request->twitter != "") {
            $arr_validator_condition['twitter'] = 'unique:users,twitter';
        }
        if (isset($request->facebook) && $request->facebook != "") {
            $arr_validator_condition['facebook'] = 'unique:users,facebook';
        }
        if (isset($request->instagram) && $request->instagram != "") {
            $arr_validator_condition['instagram'] = 'unique:users,instagram';
        }
        $validator = \Validator::make($request->all(), $arr_validator_condition);


        $is_valid = false;
        if ($validator->fails()) {
            $is_valid = false;
        }

        $updated = false;

        $is_valid = true;
        if ($is_valid) {
            try {
                $updated = DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'firstname'		 => $request->firstname,
                        'lastname'		  => $request->lastname,
                        'company'		   => $request->company,
                        'position'		  => $request->position,
                        'products_services' => $request->prod,
                        'industry'		  => $request->industry,
                        'email'			 => $request->email,
                        'phone'			 => $request->phone,
                        'country'		   => $request->country,
                        'city'			  => $request->city,
                        'state'			 => $request->state,
                        'zip'			   => $request->zip,
                        'compweb'		   => $request->compweb,
                        'website'		   => $request->website,
                        'twitter'		   => $request->twitter,
                        'linkedin'		  => $request->linkedin,
                        'facebook'		  => $request->facebook,
                        'instagram'		 => $request->instagram,
                        'bio' => $request->bio,
                        'speaker_presenter' => $request->speaker,
                    ]);
                //} catch(exception $e) {
            } catch (\Illuminate\Database\QueryException $e) {
                //print "exception caught\n";
            }
        }

        if($updated){
            session()->put('info', 'You\'re personal information has been updated.');
            //session()->put('tabName', 'contact');
            return redirect()->route('profile')->with('tab','contact');
            //return redirect('/profile')->with('tabName','contact');
            //echo json_encode(array('status'=>1));
        }else {
            if (!$is_valid) {
                $error_messages = "";
                $errors = $validator->errors();
                if (is_array($errors->all())) {
                    foreach ($errors->all() as $message) {
                        $error_messages .= ", ".$message;
                    }
                }
                /*
                if (is_object($errors) && isset($errors->messages) && (is_array($errors->messages))) {
                    for($n=0;$n<count($errors->messages);$n++) {
                    }
                }
                */
                $error_messages = trim($error_messages, ", ");
                //print "error is $error_messages\n";
                //print_r($validator->errors());
                //exit(0);
                session()->put('error', "There was an issue updating your information. $error_messages");
            } else {
                session()->put('error', 'There was an issue updating your information.');
            }
            return back()->with('tab','contact');
            //echo json_encode(array('status'=>0));
        }
    }
    public function skillsupdate(Request $request, $id) {

        /* foreach($request->skills as $skill){
             DB::table('skills')
                 ->where('user_id', $id)
                 ->where('skills', $skill)
                 ->get();
         }*/
        $is_add = true;

        if (is_null($request->skills)) {
            $is_add = false;
        }

        if ($is_add && $id > 0) {
            if(DB::table('skills')->where('user_id', $id)->value('skills')) {
                $present = true;
            } else{
                $present =false;
            }

            if(!$present){
                $updated = DB::table('skills')
                    ->insert([
                        'user_id' => $id,
                        'skills'   => $request->skills,
                    ]);
            } else{
                $updated = DB::table('skills')
                    ->update([
                        'user_id' => $id,
                        'skills'   => $request->skills,
                    ]);
            }
            if($updated){
                session()->put('info', 'Skills have been updated.');
                return redirect('/profile')->with('tab','skills');
            } else {
                session()->put('error', 'Skills were not updated.');
                return back()->with('tab','skills');
            }
        } else {
            session()->put('error', 'Skills cannot be blank.');
            return back()->with('tab','skills');
        }
    }

    public function companyupdate(Request $request, $id)
    {

        $notPresent = [];
        $notPresent2 = [];
        $compupdate = DB::table('companies')
            ->where('company_name', Auth::user()->company)
            ->update([
                'company_address'   => $request->compaddress,
                'city'		   => $request->compcity,
                'state'			 => $request->compstate,
                'country'		=> $request->compcountry,
                'zip'			 => $request->compzip,
                'phone'		   => $request->compphone,
                'fax'			  => $request->compfax,
            ]);
        if($compupdate){
            session()->put('info', 'Updated company information.');
            return back();
        }else{
            session()->put('error', 'There was an issue updating your company information.');
            return back();
        }
    }

    public function companymemberupdate(Request $request)
    {

        DB::table('company_members')
            ->where('user_id', $request->memberid)
            ->delete();
        DB::table('users')
            ->where('id', $request->memberid)
            ->update([
                'lastpayment' => null,
                'company' => null,
            ]);

        session()->put('info', 'Member has been removed from the company.');
        return back();
    }

    public function AddCompanyMember(Request $request)
    {
        $this->validate($request,[
            'firstname'	 => 'required',
            'lastname'	  => 'required',
            'username'	  => 'required|unique:users,username',
            'email'		 => 'required|unique:users,email',
            'password'	  => 'required',
            'country'	   => 'required',
            'state'		 => 'required',
        ]);

        $Compuser = $this->user->create([
            'firstname'		 => $request->firstname,
            'lastname'		  => $request->lastname,
            'username'		  => $request->username,
            'email'			 => $request->email,
            'hash'			  => sha1($request->email),
            'password'		  => bcrypt($request->password),
            'country'		   => $request->country,
            'state'			 => $request->state,
            'gravatar'		  => '/storage/app/public/default_avatar.jpeg',
            'lastpayment'	   => $request->lastpayment,
        ]);
        if($Compuser){
            event(new NewUser($Compuser));
            event(new CompUser($Compuser, $request->password));
            $compid = DB::table('companies')
                ->where('company_name', $request->company)
                ->value('id');
            DB::table('company_members')
                ->insert([
                    'user_id'	   => $Compuser->id,
                    'company_id'	=> $compid,
                ]);

            DB::table('users')
                ->where('id', $Compuser->id)
                ->update([
                    'lastpayment' => Carbon::now(),
                ]);
            DB::table('recentactivity')
                ->insert([
                    'user_id'   => $Compuser->id,
                    'activity'  => 'Membership Updated By Company, New expiration is '. Carbon::now(),
                    'created_at'	=> Carbon::now(),
                    'updated_at'	=> Carbon::now(),
                ]);
        }
        return back();
    }

    public function dietUpdate(Request $request,$id)
    {

        $is_valid = true;
        $error_message = "";

        if (!isset($request->firstevent) || is_null($request->firstevent)) {
            $request->firstevent = 0;
            //$is_valid = false;
            //$error_message = "Missing First Event";
        }

        /*
        if (!isset($request->dietrestriction) || is_null($request->dietrestriction)) {
            $is_valid = false;
            $error_message = "Diet Restriction cannot be blank";
        }
        */

        if ($is_valid) {
            if(DB::table('event_extra_info')->where('user_id', $id)->value('dietrestriction')){
                $present = true;
            } else {
                $present = false;
            }
            if(!$present){
                DB::table('event_extra_info')
                    ->insert([
                        'user_id' => $id,
                        'dietrestriction' => $request->dietrestriction,
                        'firstevent' => $request->firstevent,
                    ]);
                session()->put('success', 'Event information saved.');
                return redirect()->route('profile')->with('tab','addeventinfo');
            } else {
                DB::table('event_extra_info')
                    ->where('user_id', $id)
                    ->update([
                        'dietrestriction' => $request->dietrestriction,
                        'firstevent' => $request->firstevent,
                    ]);
                session()->put('success', 'Event information updated.');
                return redirect()->route('profile')->with('tab','addeventinfo');
            }
        } else {
            session()->put('error', $error_message);
            return back()->with('tab','addeventinfo');
        }
    }


    public function RandomAdvert()
    {
        $advert = DB::table('adverts')
            ->inRandomOrder()
            ->first();
//dd($advert);
        return $advert;
    }

    public function resetpass()
    {
        Auth::logout();
        return \redirect('/password/reset');
    }
}
