<?php
/**
 * SCallback for the Schema organization type field.
 *
 * @package    PT_Plugin
 * @subpackage Admin\Partials\Field_Callbacks
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace PT_Plugin\Admin\Partials\Field_Callbacks;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$types = [

	// First option save null.
	null          => __( 'Select one&hellip;', 'pt-plugin' ),
	'Airline'     => __( 'Airline', 'pt-plugin' ),
	'Corporation' => __( 'Corporation', 'pt-plugin' ),

	// Educational Organizations.
	'EducationalOrganization' => __( 'Educational Organization', 'pt-plugin' ),
		'CollegeOrUniversity' => __( '— College or University', 'pt-plugin' ),
		'ElementarySchool'    => __( '— Elementary School', 'pt-plugin' ),
		'HighSchool'          => __( '— High School', 'pt-plugin' ),
		'MiddleSchool'        => __( '— Middle School', 'pt-plugin' ),
		'Preschool'           => __( '— Preschool', 'pt-plugin' ),
		'School'              => __( '— School', 'pt-plugin' ),

	'GovernmentOrganization'  => __( 'Government Organization', 'pt-plugin' ),

	// Local Businesses.
	'LocalBusiness' => __( 'Local Business', 'pt-plugin' ),
		'AnimalShelter' => __( '— Animal Shelter', 'pt-plugin' ),

		// Automotive Businesses.
		'AutomotiveBusiness' => __( '— Automotive Business', 'pt-plugin' ),
			'AutoBodyShop'     => __( '—— Auto Body Shop', 'pt-plugin' ),
			'AutoDealer'       => __( '—— Auto Dealer', 'pt-plugin' ),
			'AutoPartsStore'   => __( '—— Auto Parts Store', 'pt-plugin' ),
			'AutoRental'       => __( '—— Auto Rental', 'pt-plugin' ),
			'AutoRepair'       => __( '—— Auto Repair', 'pt-plugin' ),
			'AutoWash'         => __( '—— Auto Wash', 'pt-plugin' ),
			'GasStation'       => __( '—— Gas Station', 'pt-plugin' ),
			'MotorcycleDealer' => __( '—— Motorcycle Dealer', 'pt-plugin' ),
			'MotorcycleRepair' => __( '—— Motorcycle Repair', 'pt-plugin' ),

		'ChildCare'            => __( '— Child Care', 'pt-plugin' ),
		'Dentist'              => __( '— Dentist', 'pt-plugin' ),
		'DryCleaningOrLaundry' => __( '— Dry Cleaning or Laundry', 'pt-plugin' ),

		// Emergency Services.
		'EmergencyService' => __( '— Emergency Service', 'pt-plugin' ),
			'FireStation'   => __( '—— Fire Station', 'pt-plugin' ),
			'Hospital'      => __( '—— Hospital', 'pt-plugin' ),
			'PoliceStation' => __( '—— Police Station', 'pt-plugin' ),

		'EmploymentAgency' => __( '— Employment Agency', 'pt-plugin' ),

		// Entertainment Businesses.
		'EntertainmentBusiness' => __( '— Entertainment Business', 'pt-plugin' ),
			'AdultEntertainment' => __( '—— Adult Entertainment', 'pt-plugin' ),
			'AmusementPark'      => __( '—— Amusement Park', 'pt-plugin' ),
			'ArtGallery'         => __( '—— Art Gallery', 'pt-plugin' ),
			'Casino'             => __( '—— Casino', 'pt-plugin' ),
			'ComedyClub'         => __( '—— Comedy Club', 'pt-plugin' ),
			'MovieTheater'       => __( '—— Movie Theater', 'pt-plugin' ),
			'NightClub'          => __( '—— Night Club', 'pt-plugin' ),

		// Financial Services.
		'FinancialService' => __( '— Financial Service', 'pt-plugin' ),
			'AccountingService' => __( '—— Accounting Service', 'pt-plugin' ),
			'AutomatedTeller'   => __( '—— Automated Teller', 'pt-plugin' ),
			'BankOrCreditUnion' => __( '—— Bank or Credit Union', 'pt-plugin' ),
			'InsuranceAgency'   => __( '—— Insurance Agency', 'pt-plugin' ),

		// Food Establishments.
		'FoodEstablishment' => __( '— Food Establishment', 'pt-plugin' ),
			'Bakery'             => __( '—— Bakery', 'pt-plugin' ),
			'BarOrPub'           => __( '—— Bar or Pub', 'pt-plugin' ),
			'Brewery'            => __( '—— Brewery', 'pt-plugin' ),
			'CafeOrCoffeeShop'   => __( '—— Cafe or Coffee Shop', 'pt-plugin' ),
			'FastFoodRestaurant' => __( '—— Fast Food Restaurant', 'pt-plugin' ),
			'IceCreamShop'       => __( '—— Ice Cream Shop', 'pt-plugin' ),
			'Restaurant'         => __( '—— Restaurant', 'pt-plugin' ),
			'Winery'             => __( '—— Winery', 'pt-plugin' ),

		// Government Offices.
		'GovernmentOffice' => __( '— Government Office', 'pt-plugin' ),
			'PostOffice' => __( '—— Post Office', 'pt-plugin' ),

		// Health and Beauty Businesses.
		'HealthAndBeautyBusiness' => __( '— Health and Beauty Business', 'pt-plugin' ),
			'BeautySalon'  => __( '—— Beauty Salon', 'pt-plugin' ),
			'DaySpa'       => __( '—— Day Spa', 'pt-plugin' ),
			'HairSalon'    => __( '—— Hair Salon', 'pt-plugin' ),
			'HealthClub'   => __( '—— Health Club', 'pt-plugin' ),
			'NailSalon'    => __( '—— Nail Salon', 'pt-plugin' ),
			'TattooParlor' => __( '—— Tattoo Parlor', 'pt-plugin' ),

		// Home and Construction Businesses.
		'HomeAndConstructionBusiness' => __( '— Home and Construction Business', 'pt-plugin' ),
			'Electrician'       => __( '—— Electrician', 'pt-plugin' ),
			'GeneralContractor' => __( '—— General Contractor', 'pt-plugin' ),
			'HVACBusiness'      => __( '—— HVAC Business', 'pt-plugin' ),
			'HousePainter'      => __( '—— House Painter', 'pt-plugin' ),
			'Locksmith'         => __( '—— Locksmith', 'pt-plugin' ),
			'MovingCompany'     => __( '—— MovingCompany', 'pt-plugin' ),
			'Plumber'           => __( '—— Plumber', 'pt-plugin' ),
			'RoofingContractor' => __( '—— Roofing Contractor', 'pt-plugin' ),

		'InternetCafe' => __( '— Internet Cafe', 'pt-plugin' ),

		// Legal Services.
		'LegalService' => __( '— Legal Service', 'pt-plugin' ),
			'Attorney' => __( '—— Attorney', 'pt-plugin' ),
			'Notary'   => __( '—— Notary', 'pt-plugin' ),

		'Library' => __( '— Library', 'pt-plugin' ),

		// Lodging Businesses.
		'LodgingBusiness' => __( '— Lodging Business', 'pt-plugin' ),
			'BedAndBreakfast' => __( '—— Bed and Breakfast', 'pt-plugin' ),
			'Campground'      => __( '—— Campground', 'pt-plugin' ),
			'Hostel'          => __( '—— Hostel', 'pt-plugin' ),
			'Hotel'           => __( '—— Hotel', 'pt-plugin' ),
			'Motel'           => __( '—— Motel', 'pt-plugin' ),
			'Resort'          => __( '—— Resort', 'pt-plugin' ),

		'ProfessionalService' => __( '— Professional Service', 'pt-plugin' ),
		'RadioStation'        => __( '— Radio Station', 'pt-plugin' ),
		'RealEstateAgent'     => __( '— Real Estate Agent', 'pt-plugin' ),
		'RecyclingCenter'     => __( '— Recycling Center', 'pt-plugin' ),
		'SelfStorage'         => __( '— Self Storage', 'pt-plugin' ),
		'ShoppingCenter'      => __( '— Shopping Center', 'pt-plugin' ),

		// Sports Activity Locations.
		'SportsActivityLocation' => __( '— Sports Activity Location', 'pt-plugin' ),
			'BowlingAlley'       => __( '—— Bowling Alley', 'pt-plugin' ),
			'ExerciseGym'        => __( '—— Exercise Gym', 'pt-plugin' ),
			'GolfCourse'         => __( '—— Golf Course', 'pt-plugin' ),
			'HealthClub'         => __( '—— Health Club', 'pt-plugin' ),
			'PublicSwimmingPool' => __( '—— Public Swimming Pool', 'pt-plugin' ),
			'SkiResort'          => __( '—— Ski Resort', 'pt-plugin' ),
			'SportsClub'         => __( '—— Sports Club', 'pt-plugin' ),
			'StadiumOrArena'     => __( '—— Stadium or Arena', 'pt-plugin' ),
			'TennisComplex'      => __( '—— Tennis Complex', 'pt-plugin' ),

		// Store types.
		'Store' => __( '— Store', 'pt-plugin' ),
			'AutoPartsStore'      => __( '—— Auto Parts Store', 'pt-plugin' ),
			'BikeStore'           => __( '—— Bike Store', 'pt-plugin' ),
			'BookStore'           => __( '—— Book Store', 'pt-plugin' ),
			'ClothingStore'       => __( '—— Clothing Store', 'pt-plugin' ),
			'ComputerStore'       => __( '—— Computer Store', 'pt-plugin' ),
			'ConvenienceStore'    => __( '—— Convenience Store', 'pt-plugin' ),
			'DepartmentStore'     => __( '—— Department Store', 'pt-plugin' ),
			'ElectronicsStore'    => __( '—— Electronics Store', 'pt-plugin' ),
			'Florist'             => __( '—— Florist', 'pt-plugin' ),
			'FurnitureStore'      => __( '—— Furniture Store', 'pt-plugin' ),
			'GardenStore'         => __( '—— Garden Store', 'pt-plugin' ),
			'GroceryStore'        => __( '—— Grocery Store', 'pt-plugin' ),
			'HardwareStore'       => __( '—— Hardware Store', 'pt-plugin' ),
			'HobbyShop'           => __( '—— Hobby Shop', 'pt-plugin' ),
			'HomeGoodsStore'      => __( '—— Home Goods Store', 'pt-plugin' ),
			'JewelryStore'        => __( '—— Jewelry Store', 'pt-plugin' ),
			'LiquorStore'         => __( '—— Liquor Store', 'pt-plugin' ),
			'MensClothingStore'   => __( '—— Mens Clothing Store', 'pt-plugin' ),
			'MobilePhoneStore'    => __( '—— Mobile Phone Store', 'pt-plugin' ),
			'MovieRentalStore'    => __( '—— Movie Rental Store', 'pt-plugin' ),
			'MusicStore'          => __( '—— Music Store', 'pt-plugin' ),
			'OfficeEquipmentStore'=> __( '—— Office Equipment Store', 'pt-plugin' ),
			'OutletStore'         => __( '—— Outlet Store', 'pt-plugin' ),
			'PawnShop'            => __( '—— Pawn Shop', 'pt-plugin' ),
			'PetStore'            => __( '—— Pet Store', 'pt-plugin' ),
			'ShoeStore'           => __( '—— Shoe Store', 'pt-plugin' ),
			'SportingGoodsStore'  => __( '—— Sporting Goods Store', 'pt-plugin' ),
			'TireShop'            => __( '—— Tire Shop', 'pt-plugin' ),
			'ToyStore'            => __( '—— Toy Store', 'pt-plugin' ),
			'WholesaleStore'      => __( '—— Wholesale Store', 'pt-plugin' ),

		'TelevisionStation'        => __( '— Television Station', 'pt-plugin' ),
		'TouristInformationCenter' => __( '— Tourist Information Center', 'pt-plugin' ),
		'TravelAgency'             => __( '— Travel Agency', 'pt-plugin' ),

	'MedicalOrganization' => __( 'Medical Organization', 'pt-plugin' ),
	'NGO'                 => __( 'NGO (Non-Governmental Organization', 'pt-plugin' ),
	'PerformingGroup'     => __( 'Performing Group', 'pt-plugin' ),
	'SportsOrganization'  => __( 'Sports Organization', 'pt-plugin' )
];

$options = get_option( 'schema_org_type' );

$html = '<p><select id="schema_org_type" name="schema_org_type">';

foreach( $types as $type => $value ) {

	$selected = ( $options == $type ) ? 'selected="' . esc_attr( 'selected' ) . '"' : '';

	$html .= '<option value="' . esc_attr( $type ) . '" ' . $selected . '>' . esc_html( $value ) . '</option>';

}

$html .= '</select>';
$html .= sprintf(
	'<label for="schema_org_type"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
	$args[0],
	esc_attr( esc_url( 'https://schema.org/docs/full.html#C.Organization' ) ),
	esc_attr( __( 'Read documentation for organization types', 'pt-plugin' ) )
);
$html .= '</p>';

echo $html;