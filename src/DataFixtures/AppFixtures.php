<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Message;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setPrenom('admin');
        $admin->setNom('brumen');
        $admin->setEmail('admin@mail.com');
        $adminPassword = $this->passwordHasher->hashPassword(
            $admin,
            'Test1234?'
        );
        $admin->setAvatar('defaultavatar.png');
        $admin->setPassword($adminPassword);
        $admin->setRoles(["ROLE_ADMIN"]);
        $admin->setAge(new \DateTime('now'));
        $admin->setSexe(true);
        $admin->setEnabled(true);
        $manager->persist($admin);

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setPrenom('user' . $i);
            $user->setNom('brumen' . $i);
            $user->setEmail('mail' . $i . '@mail.com');
            $plaintextPassword = 'Test1234?' . $i;

            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setAvatar('defaultavatar.png');
            $user->setAge(new \DateTime('now'));
            $user->setSexe(true);
            $user->setPassword($hashedPassword);
            $manager->persist($user);

            $post = new Post();
            $post->setTitle('post' . $i);
            $post->setContent('content' . $i);
            $post->setUser($admin);
            $post->setSlug('post' . $i);
            $manager->persist($post);

            $comment = new Comment();
            $comment->setContent('content' . $i);
            $comment->setUser($admin);
            $comment->setPost($post);
            $manager->persist($comment);
        }

        $toto = new User();
        $toto->setPrenom('toto');
        $toto->setNom('eastek');
        $toto->setEmail('toto@mail.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $toto,
            'Test1234?'
        );
        $toto->setAvatar('defaultavatar.png');
        $toto->setAge(new \DateTime('now'));
        $toto->setSexe(true);
        $toto->setPassword($hashedPassword);
        $manager->persist($toto);

        $paul = new User();
        $paul->setPrenom('paul');
        $paul->setNom('costa');
        $paul->setEmail('paul@mail.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $paul,
            'Test1234?'
        );
        $paul->setAvatar('defaultavatar.png');
        $paul->setAge(new \DateTime('now'));
        $paul->setSexe(true);
        $paul->setPassword($hashedPassword);
        $manager->persist($paul);

        $message1 = new Message();
        $message1->setContent('salut');
        $message1->setReceive($toto);
        $message1->setSend($paul);
        $manager->persist($message1);

        $message2 = new Message();
        $message2->setContent('coucou');
        $message2->setReceive($paul);
        $message2->setSend($toto);
        $manager->persist($message2);

        $message3 = new Message();
        $message3->setContent('ca va');
        $message3->setReceive($toto);
        $message3->setSend($paul);
        $manager->persist($message3);

        $message4 = new Message();
        $message4->setContent('oui et toi');
        $message4->setReceive($paul);
        $message4->setSend($toto);
        $manager->persist($message4);

        $manager->flush();
    }
}
