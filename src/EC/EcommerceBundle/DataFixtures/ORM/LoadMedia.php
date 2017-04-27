<?php

namespace EC\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EC\EcommerceBundle\Entity\Media;

class LoadMedia extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$media1 = new Media();
		$media1->setPath('http://static.lexpress.fr/medias_10560/w_1538,h_1154,c_crop,x_0,y_449/w_640,h_358,c_fill,g_center/v1441116077/legumes-de-septembre-panais-carotte-betterave-blette-poireau_5406803.jpg');
		$media1->setAlt('Légumes');
		$media1->setName('Légumes');
		$manager->persist($media1);

		$media2 = new Media();
		$media2->setPath('http://psycho2rue.fr/wp-content/uploads/2015/01/fruit_selection_155265101_web.jpg');
		$media2->setAlt('Fruits');
		$media2->setName('Fruits');
		$manager->persist($media2);

		$media3 = new Media();
		$media3->setPath('http://www.lefruitierdelee.com/Files/119268/Img/19/poivron_rouge.jpg');
		$media3->setAlt('Poivron rouge');
		$media3->setName('Poivron rouge');
		$manager->persist($media3);

		$media4 = new Media();
		$media4->setPath('http://www.gottalosefat.com/wp-content/uploads/2010/10/capsiplex1.jpeg');
		$media4->setAlt('Piment');
		$media4->setName('Piment');
		$manager->persist($media4);

		$media5 = new Media();
		$media5->setPath('http://www.passeportsante.net/DocumentsProteus/images/poivron_nu-1.jpg');
		$media5->setAlt('Poivron vert');
		$media5->setName('Poivron vert');
		$manager->persist($media5);

		$media6 = new Media();
		$media6->setPath('http://mediasv6-3.truffaut.com/Articles/jpg/0025000/25119_002_175.jpg');
		$media6->setAlt('Tomate');
		$media6->setName('Tomate');
		$manager->persist($media6);

		$media7 = new Media();
		$media7->setPath('http://www.france5.fr/emissions/sites/default/files/images/2016/10/41/10173270-16586134.jpg');
		$media7->setAlt('Raisin');
		$media7->setName('Raisin');
		$manager->persist($media7);

		$media8 = new Media();
		$media8->setPath('http://www.1parrainage.com/espace_parrain/photos/16010-photo.jpg');
		$media8->setAlt('Orange');
		$media8->setName('Orange');
		$manager->persist($media8);


		$manager->flush();

		$this->addReference('media1', $media1);
        $this->addReference('media2', $media2);
        $this->addReference('media3', $media3);
        $this->addReference('media4', $media4);
        $this->addReference('media5', $media5);        
        $this->addReference('media6', $media6);
        $this->addReference('media7', $media7);        
        $this->addReference('media8', $media8);
	}

	public function getOrder()
	{
		return 1;
	}
}