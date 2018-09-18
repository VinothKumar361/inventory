<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventoryConfigurationAdminUi\Model\ResourceModel;

use Magento\Framework\App\ResourceConnection;

/**
 * Get stock ids related to given source code.
 */
class GetStockIdsBySourceCode
{
    /**
     * @var ResourceConnection
     */
    private $resource;

    /**
     * @param ResourceConnection $resource
     */
    public function __construct(ResourceConnection $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @param string $sourceCode
     * @return array
     */
    public function execute(string $sourceCode): array
    {
        $connection = $this->resource->getConnection();
        $select = $connection->select()
            ->from(
                $this->resource->getTableName('inventory_source_stock_link'),
                'stock_id'
            )
            ->where('source_code =?', $sourceCode);

        return $connection->fetchCol($select);
    }
}