<?php

namespace EC\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EC\EcommerceBundle\Entity\Categories;

class LoadCategories extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		//Liste des noms de categories
		$names = array('1' => 'Légumes', '2' => 'Fruits');

		foreach ($names as $key => $name) {

			eval('?>'. $category = 'category'.$key .'<?php;');
			
			$category = new Categories();
			$category->setNom($name);
			$category->setImage($this->getReference('media'.$key));
			$manager->persist($category);

			$this->addReference('category'.$key, $category);
		}

		$manager->flush();

		//$this->addReference('category1', $category);
        //$this->addReference('category2', $category);
	}

	public function getOrder()
	{
		return 2;
	}
}