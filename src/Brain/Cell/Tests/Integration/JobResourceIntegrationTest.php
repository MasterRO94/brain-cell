<?php

namespace Brain\Cell\Tests\Integration;

use Brain\Cell\BrainClient;
use Brain\Cell\Client\ClientConfiguration;
use Brain\Cell\Client\RequestAdapter\GuzzleHttpRequestAdapter;
use Brain\Cell\EntityResource\Job\JobResource;
use Brain\Cell\Service\ResourceHandlerService;
use Brain\Cell\Transfer\EntityResourceFactory;
use Brain\Cell\Transformer\ArrayDecoder;
use Brain\Cell\Transformer\ArrayEncoder;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * {@inheritdoc}
 *
 * @group integration
 */
final class JobResourceIntegrationTest extends TestCase
{
    /**
     * @test
     */
    public function can(): void
    {
        $file = sprintf('%s/data/get-job.json', __DIR__);
        $json = file_get_contents($file);
        $data = json_decode($json, true);

        /** @var GuzzleHttpRequestAdapter|MockObject $adapter */
        $adapter = $this->createMock(GuzzleHttpRequestAdapter::class);
        $adapter->expects(self::once())
            ->method('request')
            ->willReturn($data);

        $configuration = new ClientConfiguration($adapter, 'some-key');
        $configuration->setResourceHandler(
            new ResourceHandlerService(
                new EntityResourceFactory(),
                new ArrayEncoder(),
                new ArrayDecoder()
            )
        );

        $client = new BrainClient($configuration);

        /** @var JobResource $job */
        $job = $client->job()->getJob('some-id');

        self::assertEquals('2018-08-13T11:36:02+0000', $job->getCreatedAt()->getIso());
        self::assertEquals('job.status.incomplete', $job->getStatus()->getCanonical());

        $clients = $job->getClients();

        self::assertEquals(3, $clients->count());
        self::assertEquals('origin', $clients[0]->getRole());
        self::assertEquals('shop', $clients[0]->getClient()->getType());

        $component = $job->getComponents()[0];

        $artwork = $component->getArtwork();
        self::assertEquals('ede24014-66d4-450e-b705-801fab463f3b', $artwork->getId());
        self::assertEquals('artwork.status.new', $artwork->getStatus()->getCanonical());
        self::assertEquals('ink', $artwork->getFiles()[0]->getLabel());
        self::assertEquals('5bced1fb-3d37-497e-968c-4318777fd02b', $artwork->getFiles()[0]->getFile()->getId());
        self::assertEquals('https://brain.dev/v1/files/5bced1fb-3d37-497e-968c-4318777fd02b/download', $artwork->getFiles()[0]->getFile()->getPath());
        self::assertEquals('finishing-ink-single', $artwork->getFiles()[0]->getFinishingItem()->getAlias());
    }
}
