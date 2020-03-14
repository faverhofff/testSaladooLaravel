<?php namespace Tests\Repositories;

use App\Models\product;
use App\Repositories\productRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class productRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var productRepository
     */
    protected $productRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productRepo = \App::make(productRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product()
    {
        $product = factory(product::class)->make()->toArray();

        $createdproduct = $this->productRepo->create($product);

        $createdproduct = $createdproduct->toArray();
        $this->assertArrayHasKey('id', $createdproduct);
        $this->assertNotNull($createdproduct['id'], 'Created product must have id specified');
        $this->assertNotNull(product::find($createdproduct['id']), 'product with given id must be in DB');
        $this->assertModelData($product, $createdproduct);
    }

    /**
     * @test read
     */
    public function test_read_product()
    {
        $product = factory(product::class)->create();

        $dbproduct = $this->productRepo->find($product->id);

        $dbproduct = $dbproduct->toArray();
        $this->assertModelData($product->toArray(), $dbproduct);
    }

    /**
     * @test update
     */
    public function test_update_product()
    {
        $product = factory(product::class)->create();
        $fakeproduct = factory(product::class)->make()->toArray();

        $updatedproduct = $this->productRepo->update($fakeproduct, $product->id);

        $this->assertModelData($fakeproduct, $updatedproduct->toArray());
        $dbproduct = $this->productRepo->find($product->id);
        $this->assertModelData($fakeproduct, $dbproduct->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product()
    {
        $product = factory(product::class)->create();

        $resp = $this->productRepo->delete($product->id);

        $this->assertTrue($resp);
        $this->assertNull(product::find($product->id), 'product should not exist in DB');
    }
}
