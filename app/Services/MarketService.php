<?php

	namespace App\Services;


	use App\Traits\AuthorizesMarketRequest;
	use App\Traits\ConsumesExternalServices;
	use App\Traits\InteractsWithMarketResponses;
	use stdClass;

	class MarketService
	{
		use ConsumesExternalServices, AuthorizesMarketRequest, InteractsWithMarketResponses;

		protected $baseUri;

		public function __construct()
		{
			$this->baseUri = config('services.market.base_uri');
		}

		public function getProducts()
		{
			return $this->makeRequest('GET', 'products');
		}

		public function getCategories()
		{
			return $this->makeRequest('GET', 'categories');
		}

		public function getCategoryProducts($id)
		{
			return $this->makeRequest('GET', "categories/{$id}/products");
		}

		public function getUserInformation()
		{
			return $this->makeRequest('GET', "users/me");
		}

		/**
		 * * Obtains a product from the API
		 * @param int $id
		 * @return string
		 */
		public function getProduct($id): string
		{
			return $this->makeRequest('GET', "products/{$id}");
		}

		/**
		 * @param int $sellerId
		 * @param array $productData
		 * @return stdClass
		 */
		public function publishProduct(int $sellerId, array $productData): string
		{
			return $this->makeRequest(
				'POST',
				"sellers/{$sellerId}/products",
				[],
				$productData,
				[],
				$hasFile = true
			);
		}

		/**
		 * @param int $productId
		 * @param int $categoryId
		 * @return stdClass
		 */
		public function setProductCategory(int $productId, int $categoryId): string
		{
			return $this->makeRequest(
				'PUT',
				"products/{$productId}/categories/{$categoryId}"
			);
		}

		/**
		 * @param int $sellerId
		 * @param int $productId
		 * @param array $productData
		 * @return stdClass
		 */
		public function updateProduct(int $sellerId, int $productId,array $productData): string
		{
			$productData['_method'] = 'PUT';

			return $this->makeRequest(
				'POST',
				"sellers/{$sellerId}/products/{$productId}",
				[],
				$productData,
				[],
				$hasFile = isset($productData['picture'])
			);
		}

		/**
		 * @param int $productId
		 * @param int $buyerId
		 * @param int $quantity
		 * @return stdClass
		 */
		public function purchaseProduct(int $productId,int $buyerId,int $quantity): string
		{
						return $this->makeRequest(
				'POST',
				"products/{$productId}/buyers/{$buyerId}/transactions",
				[],
				['quantity' => $quantity]
			);
		}

		/**
		 * @param $buyerId
		 * @return string
		 */
		public function getPurchases($buyerId)
		{
			return $this->makeRequest('GET', "buyers/{$buyerId}/products");
		}

		/**
		 * @param int $sellerId
		 * @return string
		 */
		public function getPublications(int $sellerId) :string
		{
			return $this->makeRequest('GET', "sellers/{$sellerId}/products");
		}
	}
