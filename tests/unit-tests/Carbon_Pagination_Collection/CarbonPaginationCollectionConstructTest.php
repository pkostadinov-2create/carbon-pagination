<?php

class CarbonPaginationCollectionConstructTest extends WP_UnitTestCase {

	public function setUp() {
		$args = array(
			'enable_prev' => true,
		);
		$paginationStub = $this->getMockForAbstractClass( 'Carbon_Pagination', $args );
		$this->pagination = $paginationStub;
	}

	public function tearDown() {
		unset( $this->pagination );
	}

	public function testIfPaginationProperlySet() {
		$params = array($this->pagination);
		$collection = $this->getMock('Carbon_Pagination_Collection', null, $params);
		$this->assertSame( $this->pagination, $collection->get_pagination() );
	}

	public function testAutoGenerateDefaultEnabled() {
		$params = array($this->pagination);
		$collection = $this->getMock('Carbon_Pagination_Collection', null, $params);
		$this->assertGreaterThan(0, count($collection->get_items()));
	}

	public function testAutoGenerateDisabledByParam() {
		$params = array($this->pagination, false);
		$collection = $this->getMock('Carbon_Pagination_Collection', null, $params);
		$this->assertSame(array(), $collection->get_items());
	}

	public function testAutoGenerateDisabledByFilter() {
		add_filter('carbon_pagination_autogenerate_collection_items', '__return_false');

		$params = array($this->pagination);
		$collection = $this->getMock('Carbon_Pagination_Collection', null, $params);
		$this->assertSame(array(), $collection->get_items());

		remove_filter('carbon_pagination_autogenerate_collection_items', '__return_false');
	}

}