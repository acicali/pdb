<?php

class DataGenerator
{

    // return all method names that start with "__"
    public static function availableTypes(){
        $methods = get_class_methods(__CLASS__);
        $types = array_filter($types, function($type){
            return stripos('__', $type) === false;
        });
        return array_map(function($type){
            return str_replace('__', '', $type);
        }, $types);
    }

    // returns a single random array element
    private static function randomElement($array){
        $count = count(self::$array);
        return self::$array[
            mt_rand(0, count($count) - 1)
        ];
    }

    public static function __string_firstName(){
        return mt_rand(0, 1)
            ? self::__femaleFirstName()
            : self::__maleFirstName();
    }

    public static function __string_maleFirstName(){
        return self::randomElement(self::$male_names);
    }

    public static function __string_femaleFirstName(){
        return self::randomElement(self::$female_names);
    }

    public static function __string_lastName(){
        return self::randomElement(self::$last_names);
    }

    public static function __int_integer(){
        return mt_rand(0, 65536);
    }

    public static function __float_float(){
        return
            (self::__int_integer() + 1)
            / (self::_int_integer() + 1)
            * .1;
    }

    public static function __string_string(){
        return false;
    }

    public static function __string_city(){
        return false;
    }

    public static function __string_state(){
        return false;
    }

    public static function __string_country(){
        return self::randomElement(self::$countries);
    }

    public static function __string_address(){
        return false;
    }

    public static function __string_phone(){
        return false;
    }

    private static $countries = array(
        'Afghanistan',
        'Albania',
        'Algeria',
        'Andorra',
        'Angola',
        'Antigua and Barbuda',
        'Argentina',
        'Armenia',
        'Australia',
        'Austria',
        'Azerbaijan',
        'Bahamas',
        'Bahrain',
        'Bangladesh',
        'Barbados',
        'Belarus',
        'Belgium',
        'Belize',
        'Benin',
        'Bhutan',
        'Bolivia',
        'Bosnia and Herzegovina',
        'Botswana',
        'Brazil',
        'Brunei',
        'Bulgaria',
        'Burkina Faso',
        'Burundi',
        'Cabo Verde',
        'Cambodia',
        'Cameroon',
        'Canada',
        'Central African Republic',
        'Chad',
        'Chile',
        'China',
        'Colombia',
        'Comoros',
        'Democratic Republic of the Congo',
        'Republic of the Congo',
        'Costa Rica',
        'Croatia',
        'Cuba',
        'Cyprus',
        'Czech Republic',
        'Denmark',
        'Djibouti',
        'Dominica',
        'Dominican Republic',
        'Ecuador',
        'Egypt',
        'El Salvador',
        'Equatorial Guinea',
        'Eritrea',
        'Estonia',
        'Ethiopia',
        'Fiji',
        'Finland',
        'France',
        'Gabon',
        'Gambia',
        'Georgia',
        'Germany',
        'Ghana',
        'Greece',
        'Grenada',
        'Guatemala',
        'Guinea',
        'Guinea-Bissau',
        'Guyana',
        'Haiti',
        'Honduras',
        'Hungary',
        'Iceland',
        'India',
        'Indonesia',
        'Iran',
        'Iraq',
        'Ireland',
        'Israel',
        'Italy',
        'Jamaica',
        'Japan',
        'Jordan',
        'Kazakhstan',
        'Kenya',
        'Kiribati',
        'Kosovo',
        'Kuwait',
        'Kyrgyzstan',
        'Laos',
        'Latvia',
        'Lebanon',
        'Lesotho',
        'Liberia',
        'Libya',
        'Liechtenstein',
        'Lithuania',
        'Luxembourg',
        'Macedonia',
        'Madagascar',
        'Malawi',
        'Malaysia',
        'Maldives',
        'Mali',
        'Malta',
        'Marshall Islands',
        'Mauritania',
        'Mauritius',
        'Mexico',
        'Micronesia',
        'Moldova',
        'Monaco',
        'Mongolia',
        'Montenegro',
        'Morocco',
        'Mozambique',
        'Myanmar',
        'Namibia',
        'Nauru',
        'Nepal',
        'Netherlands',
        'New Zealand',
        'Nicaragua',
        'Niger',
        'Nigeria',
        'North Korea',
        'Norway',
        'Oman',
        'Pakistan',
        'Palau',
        'Palestine',
        'Panama',
        'Papua New Guinea',
        'Paraguay',
        'Peru',
        'Philippines',
        'Poland',
        'Portugal',
        'Qatar',
        'Romania',
        'Russia',
        'Rwanda',
        'Saint Kitts and Nevis',
        'Saint Lucia',
        'Saint Vincent and the Grenadines',
        'Samoa',
        'San Marino',
        'Sao Tome and Principe',
        'Saudi Arabia',
        'Senegal',
        'Serbia',
        'Seychelles',
        'Sierra Leone',
        'Singapore',
        'Slovakia',
        'Slovenia',
        'Solomon Islands',
        'Somalia',
        'South Africa',
        'South Korea',
        'South Sudan',
        'Spain',
        'Sri Lanka',
        'Sudan',
        'Suriname',
        'Swaziland',
        'Sweden',
        'Switzerland',
        'Syria',
        'Taiwan',
        'Tajikistan',
        'Tanzania',
        'Thailand',
        'Timor-Leste',
        'Togo',
        'Tonga',
        'Trinidad and Tobago',
        'Tunisia',
        'Turkey',
        'Turkmenistan',
        'Tuvalu',
        'Uganda',
        'Ukraine',
        'United Arab Emirates',
        'United Kingdom',
        'United States',
        'Uruguay',
        'Uzbekistan',
        'Vanuatu',
        'Venezuela',
        'Vietnam',
        'Yemen',
        'Zambia',
        'Zimbabwe'
    );

    $male_names = array(
        'james',
        'john',
        'robert',
        'michael',
        'william',
        'david',
        'richard',
        'charles',
        'joseph',
        'thomas',
        'christopher',
        'daniel',
        'paul',
        'mark',
        'donald',
        'george',
        'kenneth',
        'steven',
        'edward',
        'brian',
        'ronald',
        'anthony',
        'kevin',
        'jason',
        'matthew',
        'gary',
        'timothy',
        'jose',
        'larry',
        'jeffrey',
        'frank',
        'scott',
        'eric',
        'stephen',
        'andrew',
        'raymond',
        'gregory',
        'joshua',
        'jerry',
        'dennis',
        'walter',
        'patrick',
        'peter',
        'harold',
        'douglas',
        'henry',
        'carl',
        'arthur',
        'ryan',
        'roger',
        'joe',
        'juan',
        'jack',
        'albert',
        'jonathan',
        'justin',
        'terry',
        'gerald',
        'keith',
        'samuel',
        'willie',
        'ralph',
        'lawrence',
        'nicholas',
        'roy',
        'benjamin',
        'bruce',
        'brandon',
        'adam',
        'harry',
        'fred',
        'wayne',
        'billy',
        'steve',
        'louis',
        'jeremy',
        'aaron',
        'randy',
        'howard',
        'eugene',
        'carlos',
        'russell',
        'bobby',
        'victor',
        'martin',
        'ernest',
        'phillip',
        'todd',
        'jesse',
        'craig',
        'alan',
        'shawn',
        'clarence',
        'sean',
        'philip',
        'chris',
        'johnny',
        'earl',
        'jimmy',
        'antonio',
        'danny',
        'bryan',
        'tony',
        'luis',
        'mike',
        'stanley',
        'leonard',
        'nathan',
        'dale',
        'manuel',
        'rodney',
        'curtis',
        'norman',
        'allen',
        'marvin',
        'vincent',
        'glenn',
        'jeffery',
        'travis',
        'jeff',
        'chad',
        'jacob',
        'lee',
        'melvin',
        'alfred',
        'kyle',
        'francis',
        'bradley',
        'jesus',
        'herbert',
        'frederick',
        'ray',
        'joel',
        'edwin',
        'don',
        'eddie',
        'ricky',
        'troy',
        'randall',
        'barry',
        'alexander',
        'bernard',
        'mario',
        'leroy',
        'francisco',
        'marcus',
        'micheal',
        'theodore',
        'clifford',
        'miguel',
        'oscar',
        'jay',
        'jim',
        'tom',
        'calvin',
        'alex',
        'jon',
        'ronnie',
        'bill',
        'lloyd',
        'tommy',
        'leon',
        'derek',
        'warren',
        'darrell',
        'jerome',
        'floyd',
        'leo',
        'alvin',
        'tim',
        'wesley',
        'gordon',
        'dean',
        'greg',
        'jorge',
        'dustin',
        'pedro',
        'derrick',
        'dan',
        'lewis',
        'zachary',
        'corey',
        'herman',
        'maurice',
        'vernon',
        'roberto',
        'clyde',
        'glen',
        'hector',
        'shane',
        'ricardo',
        'sam',
        'rick',
        'lester',
        'brent',
        'ramon',
        'charlie',
        'tyler',
        'gilbert',
        'gene'
    );

    $female_names = array(
        'mary',
        'patricia',
        'linda',
        'barbara',
        'elizabeth',
        'jennifer',
        'maria',
        'susan',
        'margaret',
        'dorothy',
        'lisa',
        'nancy',
        'karen',
        'betty',
        'helen',
        'sandra',
        'donna',
        'carol',
        'ruth',
        'sharon',
        'michelle',
        'laura',
        'sarah',
        'kimberly',
        'deborah',
        'jessica',
        'shirley',
        'cynthia',
        'angela',
        'melissa',
        'brenda',
        'amy',
        'anna',
        'rebecca',
        'virginia',
        'kathleen',
        'pamela',
        'martha',
        'debra',
        'amanda',
        'stephanie',
        'carolyn',
        'christine',
        'marie',
        'janet',
        'catherine',
        'frances',
        'ann',
        'joyce',
        'diane',
        'alice',
        'julie',
        'heather',
        'teresa',
        'doris',
        'gloria',
        'evelyn',
        'jean',
        'cheryl',
        'mildred',
        'katherine',
        'joan',
        'ashley',
        'judith',
        'rose',
        'janice',
        'kelly',
        'nicole',
        'judy',
        'christina',
        'kathy',
        'theresa',
        'beverly',
        'denise',
        'tammy',
        'irene',
        'jane',
        'lori',
        'rachel',
        'marilyn',
        'andrea',
        'kathryn',
        'louise',
        'sara',
        'anne',
        'jacqueline',
        'wanda',
        'bonnie',
        'julia',
        'ruby',
        'lois',
        'tina',
        'phyllis',
        'norma',
        'paula',
        'diana',
        'annie',
        'lillian',
        'emily',
        'robin',
        'peggy',
        'crystal',
        'gladys',
        'rita',
        'dawn',
        'connie',
        'florence',
        'tracy',
        'edna',
        'tiffany',
        'carmen',
        'rosa',
        'cindy',
        'grace',
        'wendy',
        'victoria',
        'edith',
        'kim',
        'sherry',
        'sylvia',
        'josephine',
        'thelma',
        'shannon',
        'sheila',
        'ethel',
        'ellen',
        'elaine',
        'marjorie',
        'carrie',
        'charlotte',
        'monica',
        'esther',
        'pauline',
        'emma',
        'juanita',
        'anita',
        'rhonda',
        'hazel',
        'amber',
        'eva',
        'debbie',
        'april',
        'leslie',
        'clara',
        'lucille',
        'jamie',
        'joanne',
        'eleanor',
        'valerie',
        'danielle',
        'megan',
        'alicia',
        'suzanne',
        'michele',
        'gail',
        'bertha',
        'darlene',
        'veronica',
        'jill',
        'erin',
        'geraldine',
        'lauren',
        'cathy',
        'joann',
        'lorraine',
        'lynn',
        'sally',
        'regina',
        'erica',
        'beatrice',
        'dolores',
        'bernice',
        'audrey',
        'yvonne',
        'annette',
        'june',
        'samantha',
        'marion',
        'dana',
        'stacy',
        'ana',
        'renee',
        'ida',
        'vivian',
        'roberta',
        'holly',
        'brittany',
        'melanie',
        'loretta',
        'yolanda',
        'jeanette',
        'laurie',
        'katie',
        'kristen',
        'vanessa',
        'alma',
        'sue',
        'elsie',
        'beth',
        'jeanne'
    );

    private static $last_names = array(
        'smith',
        'johnson',
        'williams',
        'jones',
        'brown',
        'davis',
        'miller',
        'wilson',
        'moore',
        'taylor',
        'anderson',
        'thomas',
        'jackson',
        'white',
        'harris',
        'martin',
        'thompson',
        'garcia',
        'martinez',
        'robinson',
        'clark',
        'rodriguez',
        'lewis',
        'lee',
        'walker',
        'hall',
        'allen',
        'young',
        'hernandez',
        'king',
        'wright',
        'lopez',
        'hill',
        'scott',
        'green',
        'adams',
        'baker',
        'gonzalez',
        'nelson',
        'carter',
        'mitchell',
        'perez',
        'roberts',
        'turner',
        'phillips',
        'campbell',
        'parker',
        'evans',
        'edwards',
        'collins',
        'stewart',
        'sanchez',
        'morris',
        'rogers',
        'reed',
        'cook',
        'morgan',
        'bell',
        'murphy',
        'bailey',
        'rivera',
        'cooper',
        'richardson',
        'cox',
        'howard',
        'ward',
        'torres',
        'peterson',
        'gray',
        'ramirez',
        'james',
        'watson',
        'brooks',
        'kelly',
        'sanders',
        'price',
        'bennett',
        'wood',
        'barnes',
        'ross',
        'henderson',
        'coleman',
        'jenkins',
        'perry',
        'powell',
        'long',
        'patterson',
        'hughes',
        'flores',
        'washington',
        'butler',
        'simmons',
        'foster',
        'gonzales',
        'bryant',
        'alexander',
        'russell',
        'griffin',
        'diaz',
        'hayes',
        'myers',
        'ford',
        'hamilton',
        'graham',
        'sullivan',
        'wallace',
        'woods',
        'cole',
        'west',
        'jordan',
        'owens',
        'reynolds',
        'fisher',
        'ellis',
        'harrison',
        'gibson',
        'mcdonald',
        'cruz',
        'marshall',
        'ortiz',
        'gomez',
        'murray',
        'freeman',
        'wells',
        'webb',
        'simpson',
        'stevens',
        'tucker',
        'porter',
        'hunter',
        'hicks',
        'crawford',
        'henry',
        'boyd',
        'mason',
        'morales',
        'kennedy',
        'warren',
        'dixon',
        'ramos',
        'reyes',
        'burns',
        'gordon',
        'shaw',
        'holmes',
        'rice',
        'robertson',
        'hunt',
        'black',
        'daniels',
        'palmer',
        'mills',
        'nichols',
        'grant',
        'knight',
        'ferguson',
        'rose',
        'stone',
        'hawkins',
        'dunn',
        'perkins',
        'hudson',
        'spencer',
        'gardner',
        'stephens',
        'payne',
        'pierce',
        'berry',
        'matthews',
        'arnold',
        'wagner',
        'willis',
        'ray',
        'watkins',
        'olson',
        'carroll',
        'duncan',
        'snyder',
        'hart',
        'cunningham',
        'bradley',
        'lane',
        'andrews',
        'ruiz',
        'harper',
        'fox',
        'riley',
        'armstrong',
        'carpenter',
        'weaver',
        'greene',
        'lawrence',
        'elliott',
        'chavez',
        'sims',
        'austin',
        'peters',
        'kelley',
        'franklin',
        'lawson',
        'fields',
        'gutierrez',
        'ryan',
        'schmidt',
        'carr',
        'vasquez',
        'castillo',
        'wheeler',
        'chapman',
        'oliver',
        'montgomery',
        'richards',
        'williamson',
        'johnston',
        'banks',
        'meyer',
        'bishop',
        'mccoy',
        'howell',
        'alvarez',
        'morrison',
        'hansen',
        'fernandez',
        'garza',
        'harvey',
        'little',
        'burton',
        'stanley',
        'nguyen',
        'george',
        'jacobs',
        'reid',
        'kim',
        'fuller',
        'lynch',
        'dean',
        'gilbert',
        'garrett',
        'romero',
        'welch',
        'larson',
        'frazier',
        'burke',
        'hanson',
        'day',
        'mendoza',
        'moreno',
        'bowman',
        'medina',
        'fowler',
        'brewer',
        'hoffman',
        'carlson',
        'silva',
        'pearson',
        'holland',
        'douglas',
        'fleming',
        'jensen',
        'vargas',
        'byrd',
        'davidson',
        'hopkins',
        'may',
        'terry',
        'herrera',
        'wade',
        'soto',
        'walters',
        'curtis',
        'neal',
        'caldwell',
        'lowe',
        'jennings',
        'barnett',
        'graves',
        'jimenez',
        'horton',
        'shelton',
        'barrett',
        'obrien',
        'castro',
        'sutton',
        'gregory',
        'mckinney',
        'lucas',
        'miles',
        'craig',
        'rodriquez',
        'chambers',
        'holt',
        'lambert',
        'fletcher',
        'watts',
        'bates',
        'hale',
        'rhodes',
        'pena',
        'beck',
        'newman'
    );
}
