-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 15, 2024 at 04:19 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `cmt_id` int NOT NULL AUTO_INCREMENT,
  `cmt` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`cmt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`cmt_id`, `cmt`, `post_id`, `user_id`) VALUES
(7, 'You can comment here as well', 21, 13);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `g_id` int NOT NULL AUTO_INCREMENT,
  `g_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`g_id`, `g_name`) VALUES
(1, 'Adventure'),
(2, 'Comedy'),
(3, 'Horror'),
(4, 'Mystery'),
(5, 'Paranormal'),
(6, 'Science fiction');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

DROP TABLE IF EXISTS `info`;
CREATE TABLE IF NOT EXISTS `info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` blob,
  `gender` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `uname`, `email`, `password`, `avatar`, `gender`, `bio`) VALUES
(4, '', 'rajanbhandari@gmail.com', '$2y$10$iwWGGvYJbWtvX5Z2DZltSO07tmH2S7Ulh0cRwohoUnkDmcUjhn7cq', NULL, NULL, NULL),
(6, '', 'ritukhwalapala@gmail.com', '$2y$10$gtzhPGAmIJf3VmJCk2aUt.WKxQbt45/tW7zridtBwD84EnmMOI/Ta', NULL, NULL, NULL),
(13, 'ritu', 'ritu@gmail.com', '$2y$10$DDiQqu0JG8Z7wl5.c2CPzONRbOD4TZP1XfiRN5UpU749pO7Yk5x2G', 0x7368682e6a7067, 'female', 'welcome to my profile !!');

-- --------------------------------------------------------

--
-- Table structure for table `noti`
--

DROP TABLE IF EXISTS `noti`;
CREATE TABLE IF NOT EXISTS `noti` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `cmt_id` int NOT NULL,
  `cmt` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `postId` int NOT NULL,
  `userId` int NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cover_image` blob NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `abstract` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `genre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `cover_image`, `title`, `abstract`, `description`, `status`, `genre`, `user_id`, `created_at`, `updated_at`, `state`) VALUES
(21, 0x6a696e782e6a7067, 'Sample story', 'This story is not written by me and is copy pasted.______________Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, nostrum qui nemo nisi tempora voluptatem nulla laboriosam eveniet bland', 'On my last shift as a lighthouse keeper, I climbed the seventy-six spiral iron stairs and two ladders to the watch room, the number of steps the same as my age. The thwomp and snare of each step laid an ominous background score. Something wasn’t right. At that very moment, Richie Tedesco was pointing a fire extinguisher at the burning electrical panel in the engine room of his boat a few miles offshore.<br />\r\n<br />\r\nThe placard in the watch room read “Marge Mabrity, Lightkeeper—First lighted the depths on March 2nd, 1985, and hasn’t missed a night.” Already so close to forty years. I could still read the skies like a book. The lighthouse smelled of aging wood, dried-out moss, and the bitter acid spritz of corrosion. But out on the gallery deck, leaning against the handrails, there was the unmistakable scent of petrichor. The clouds in the distance grew taller, black shading growing across their swelling bellies, with the storm caps flattening under the weight of the system. I tasted the metallic hint of ozone on my tongue. I felt the intensity of the pressure in my ears and on my forehead.<br />\r\n<br />\r\nI know what you are thinking. Why had I even done it? For all those years. I guess finding lost things was always the one thing about me that was uniquely my own. And I didn’t know if I could give it up.<br />\r\n<br />\r\nA few miles back toward the mainland, Cappie patrolled the Long Island ports and seaways on his tug, waiting for salvage and rescue calls. There were still enough of them to get by. Especially with these yahoos taking up boating. But the seas were not what they used to be, and Cappie barely eked out a life of sustenance back on land. Lone rangers like us were going extinct in this world of ubiquitous connection and universal alienation. It was a world of gadgets now. But it turned out our kind was more needed than ever when the gadgets failed.<br />\r\n<br />\r\nThe three of us, in our solitary orbits, were bound on an intersecting course.<br />\r\n<br />\r\nHow many things had I retired from in a lifetime of retirements? However many it was, this one felt different. A transplant from Norway, full of Viking blood, I’d had a brief career on the national downhill skiing circuit. I’d hung that up for university. Then I’d hung up the mantle of a student for a job in forestry. Quit that to start a family. That transient period that seemed never-ending before the kids left home turned out not to be. My marriage ended too. And on and on. But the longest stint was my forty years as the Lighthouse Keeper at Montauk Point.<br />\r\n<br />\r\nIt was to be a ceremonial night.<br />\r\n<br />\r\nStill, it felt wrong.<br />\r\n<br />\r\nEven if I was pushing eighty. Who was I to buy into this twaddle about graceful exits and diminished capacity?<br />\r\n<br />\r\nMy thoughts were disturbed by a call on the radio.<br />\r\n<br />\r\nChannel 19.<br />\r\n<br />\r\nIt was Cappie.<br />\r\n<br />\r\nI didn’t want a mayday call.<br />\r\n<br />\r\nNot tonight.<br />\r\n<br />\r\n* * *<br />\r\n<br />\r\nRichie Tedesco was lost at sea.<br />\r\n<br />\r\nAs lost as lost can be.<br />\r\n<br />\r\nThe fire in the engine room had only taken minutes to put out, but the electrical lines were irreparably damaged. Hours later, when the last of the juice in the ship’s backup batteries ran out, Richie watched as the monitors with the electronic ocean maps and satellite-supported GPS positioning flickered and went black.<br />\r\n<br />\r\nRichie might as well have been surveying the moon. He had no idea of his location. It’s odd how easily we take for granted that we know where we are, never realizing how often we are hopelessly lost and don’t even know it.<br />\r\n<br />\r\nNight navigation is a real son-of-a-bitch. A swabbie mug untrained in navigation would be facing long odds of surviving such a calamity. And on the spectrum of swabbie mugs, Richie wasn’t even at the top of the class. But how did Richie get here?<br />\r\n<br />\r\nA few months back, Richie had bought a custom Sea Ray Sundancer 370 when he was promoted. Of course, he couldn’t afford the new model. He settled for a year-old model with the same look and feel, but which had been heavily used and abused by the prior owner, who was a real boater. But no bother. It was his prized possession.<br />\r\n<br />\r\nRichie hadn\'t accounted for the cost of marina dues and other ancillary costs. With the hefty loan he’d taken on the boat, he lacked the funds for all the accouterments of the boating life, things both expensive and confusing for the uninitiated seaman. These turned out to be necessary.<br />\r\n<br />\r\nRichie had skimped on maintenance and hired an inexperienced handyman named Louie (who was known around the marina as ‘Louie the Wrench’) to help with keeping the vessel seaworthy. A gamble that failed. Louie spent a lot more time on the phone with his bookie than with his wrench in hand.<br />\r\n<br />\r\nThe sun lounge and dining area in the hollowed-out front hull was what first had sold him. Richie had imagined spending long romantic weekends, with Rene, from the spring to the fall, jaunting from marina to marina, exploring the New England coast. Enjoying white wine or a martini together in the sun lounge at sundown, over a decadent charcuterie board, and raw seafood on ice.<br />\r\n<br />\r\nBy Richie’s calculations, this routine would somehow make up for his soulless existence earning obscene—but still inadequate-to-the-expected-lifestyle wages—spending all his daylight hours keeping his employer out of hot water by enforcing labyrinthine government regulations, effective only in the great lengths his employer was willing to go through and the great costs his employer was willing to expend to completely avoid the salutary, remedial purposes the regulations stood for in the first place.<br />\r\n<br />\r\nRene didn’t care about the predatory nature of the enterprise or how monotonous and unsexy the work was, but the fact that Richie was not the top dog. Not by a long shot. And there was little hope of improvement there. Five years for a promotion of title with a raise in bonus but not base pay? Rene knew what that meant long before Richie did.<br />\r\n<br />\r\nRene was not an adventurer. She was a social climber. Replacement Richie had a proper yacht, a newer model Mercedes, and a pricier high-rise condominium. He ran his own company doing something that sounded borderline illegal, and let’s be honest, probably was. He cheated on his taxes. Replacement Richie wasn’t apologizing for it either—it was a kick. He took what he wanted.<br />\r\n<br />\r\nRene spent the weekends with Replacement Richie and her exchangeable NPC girlfriends sunbathing on the deck of Replacement Richie’s yacht, surrounded by a display of designer bags and branded bathing suit pullovers and slides. The yacht stayed permanently moored at the Star Island Yacht Club & Marina (more prestigious than Richie’s Jersey City marina). The yacht was used exclusively for marina clout and cocktail convos. It never once saw the open seas all spring and summer. But everyone had a fabulous time of it and didn’t seem bothered at all.<br />\r\n<br />\r\nRene’s Instagram post of her engagement ring, anchoring her fates to Replacement Richie had done it. NPC girlfriend Vic was sure to comment first, for everyone’s knowledge, that it was, in fact, a 4.05-carat round diamond with a perfect “colorless” grade. The NPC’s knew on sight, like puppies who can sense one of their litter about to be adopted. It took Richie longer to find out. It was a $250K ring.<br />\r\n<br />\r\nIn one moment, Richie knew for certain that this romance would have no second act. He did the only thing that made sense at the time. He took to the open seas. Alone. Without telling anyone.<br />\r\n<br />\r\nRichie sat out in the sun lounge alone in the darkness trying to gain enough night vision to make out a landmark in the fog of dark. Richie had made all the rookie boating mistakes. The first rule of boat safety is not to go out alone. Chart a course. Tell a friend. Most people who get lost at sea stay lost. That is true on land as well. Despite getting his boating license, Richie skipped on-water training. The list went on and on.<br />\r\n<br />\r\nPerhaps worst of all, Richie couldn’t tell land-based lights from navigation lights from buoys and markers. He’d spent the last two hours heading further out to sea and nearly scraping the side of a three-meter-tall red ocean buoy that towered over the deck of his humble cruiser.<br />\r\n<br />\r\nAnd that was when he panicked and started firing off his flares.<br />\r\n<br />\r\n* * *<br />\r\n<br />\r\n“How is my best girl tonight?” Cappie asked.<br />\r\n<br />\r\n“Don’t be fresh with me. You old rake. You mean, with it being my last night?”<br />\r\n<br />\r\n“Ahh, fiddlesticks. Last night my arse. We both know you are gonna be buried on that rock, and me with you.”<br />\r\n<br />\r\n“As romantic as that is, I like a nice dinner and some wine before committing to a joint burial.”<br />\r\n<br />\r\n“Well, well. You little siren. Whetting my appetite. Marge, you’re gonna love this one.”<br />\r\n<br />\r\n“What is it Cappie?”<br />\r\n<br />\r\n“I’ve been tuned in on Channel 19 for the last fucking hour.” Cappie chuckled. His voice rattled. A deep raspy bass that hit like a fine brass-colored Scotch. It intoxicated my senses and warmed my chest off the first sip. It sang a lifetime of hard songs, but the calloused old heart was in there. He was old salt. Everything you imagined a seaman to be. Gray beard, sun-scorched skin, and a temperament mercurial enough to match the open seas. In his mid-seventies, Cappie was still fit and lean. But a little tired of a lifetime of wandering.<br />\r\n<br />\r\n“Sounds delightful,” I said. “Did they locate your chivalry and manners? Or have those gone the way of Davy Jones too?”<br />\r\n<br />\r\n“Get this. Some clueless yo-pro has been singing an off-key Rhianna playlist—Ree-ann-eh—all the way through, non-stop, not realizing his radio line is open. Must have pushed the microphone button into something. The radio went dark after sundown.”<br />\r\n<br />\r\n“God help us.”<br />\r\n<br />\r\n“You see that black squall coming in from the west? Well, this yo-pro, let’s call him Chadwick. Well, Chadwick here, he has been headed east out into the open seas, and he’s going to get clipped by that sail shredder on his way back to port, if he even knows enough to head back to port. Coast Guard has been trying to reach him, with no response.”<br />\r\n<br />\r\nI could hear it in his voice. Cappie’s full name was Jack “Tommy” Rogers. And Cappie was always into a bottle of his namesake. Cappie only had a few rules, and one was that he never touched the bottle until he’d finished his calls. Someone could lose their life if he broke that rule like he’d done tonight. Something serious was going on with Cappie.<br />\r\n<br />\r\n“How are the seas tonight,” I asked.<br />\r\n<br />\r\n“Seas are building. Cthulhu is growing restless. We are just chugging along on the gasoline breeze out here waiting for our damsel in distress to call for a knight in shining armor on his noble stallion or in this case a hundred-year-old tugger.”<br />\r\n<br />\r\n“Oh, Cappie! I didn’t know it was your hundredth birthday today. Happy birthday!”<br />\r\n<br />\r\n“Touché,” he said.<br />\r\n<br />\r\nCthulhu is what he called his tugboat. I asked once. I regretted it. To this day. Something about how his straight lines were like the tentacles of some weird Octopus god.<br />\r\n<br />\r\n“She’s all buttoned up, tight as a button, and I’m getting a bit high off the diesel fumes.” It was more than the diesel that Cappie was high on.<br />\r\n<br />\r\nI imagined Cappie out there. Be careful to avoid the reef, old man. I can see him threading through frigates, tankers, cutters, and cruise ships (like floating cities). I worry about Cappie.<br />\r\n<br />\r\nAnd that night, I wanted to tell him how I felt. But I tried to restrain myself.<br />\r\n<br />\r\nIt was a big night. No sense in complicating it.<br />\r\n<br />\r\n“I was afraid this was going to be a mayday call,” I said.<br />\r\n<br />\r\nThen it occurred to me, that maybe it was one.<br />\r\n<br />\r\n* * *<br />\r\n<br />\r\nIt was a moonless night. Richie couldn’t tell the sea from the sky. It was so dark that all that was visible was the wake of the ship drawing a white foam trail through the otherwise black void. There is that verse in Revelations where the heavens and earth pass away and there is no longer any sea. Richie didn’t believe in that kind of thing. But it had happened. All that was left was infinite negative space.<br />\r\n<br />\r\nRichie’s skin crawled, and his forehead dampened. The night was muggy, and an invisible cooling mist enveloped the cruiser. The only sounds were lapping waves, and the only smell was a briny whiff of sea foam.<br />\r\n<br />\r\nHow lost are you when you have lost your bearings and don’t know the distance to any safe harbor? Richie had not considered this before. The darkness is impartial. Absolute. Unforgiving. But in its grip, you felt that its horrors were custom-tailored, handcrafted, and made-to-measure. Just for you. Richie sure felt that way.<br />\r\n<br />\r\nThere was that foreboding, ominous sense. That the evils at play, which seemed resolved to engineer your demise, are the earned wages for some sin, the gravity of which you failed to appreciate. Whose wrath was stirred by your trespasses? God? Nature? Some malignant spirit of vengeance? What evil deed tipped the scales to a sentence of death? These were Richie’s thoughts.<br />\r\n<br />\r\nThe gas gauge became an instrument of terror.<br />\r\n<br />\r\nRichie cursed his reckless disregard. Why didn’t he pack extra canned goods and five more reserve five-liter fuel cans?<br />\r\n<br />\r\nHow could he have been so arrogant?<br />\r\n<br />\r\nSo foolish?<br />\r\n<br />\r\nAnd then, the rains started to fall, like icy darts from the heavens.<br />\r\n<br />\r\n* * *<br />\r\n<br />\r\n“Marge to Cappie. Where are you?”<br />\r\n<br />\r\n“Headed out to sea.”<br />\r\n<br />\r\n“What?”<br />\r\n<br />\r\n“Chadwick isn’t going to save himself.”<br />\r\n<br />\r\n“Cappie! You old fool. It isn’t safe.”<br />\r\n<br />\r\n“Don’t get sentimental on me now, you old cow. I’ve got a job to do.”<br />\r\n<br />\r\n“Stay safe out there, will you.”<br />\r\n<br />\r\nCappie barked like a dog. “Roof roof.”<br />\r\n<br />\r\nAnd that’s all I needed to hear.<br />\r\n<br />\r\n* * *<br />\r\n<br />\r\nNo one was coming to save him. That was Richie’s last thought before firing off his last flare.<br />\r\n<br />\r\nHe pulled out a pack of Marlboro Reds and lit one up.<br />\r\n<br />\r\nRichie smoked on the sun lounge and thought about his life, which might be coming to an end.<br />\r\n<br />\r\nHe judged his life poorly. He hadn’t lived it. He’d bought the marketing in the pamphlet but hadn’t pursued the dream the pamphlet was selling. And now it was too late.<br />\r\n<br />\r\nFor the first time in years, Richie felt reinvigorated. Clear. Awakened. Alive.<br />\r\n<br />\r\n* * *<br />\r\n<br />\r\nCappie’s tugger was at full tilt, boat-jumping the waves. The gales of the squall buffeted the front visor and tossed the ship among the crests, pushing it off course, making it hard to keep a broad breach and hit the waves at a clean 45° to avoid the worst of the punch of the storm.<br />\r\n<br />\r\nCappie located Richie’s cruiser. And then reached it. He took out a bullhorn and tried to tell Richie he was there, but the winds were like a dark room for sound. And Richie had no idea Cappie was out there.<br />\r\n<br />\r\nCappie pulled up and started setting the straight wires, attaching them to the stern of Richie’s cruiser. After a while, Richie came out and realized what was happening. He stood there holding tight to the table in the galley as the cruiser bobbed in the wake. After the winch brought the ships together, Cappie came aboard.<br />\r\n<br />\r\n“What you doing out here son?”<br />\r\n<br />\r\n“Long story. Can you get me back to shore?”<br />\r\n<br />\r\n“Can I? Will do is more like it. First, let’s check the vessel.”<br />\r\n<br />\r\nWhile Cappie was on the galley, inspecting the cruiser, a sadistic gust rocked the boat and Cappie tumbled over the safety pole. Richie looked down and saw he had grabbed the ropes along the trim and molding and was rocking with the boat, his legs gusting in the winds.<br />\r\n<br />\r\n“Get the line from the capstan on my boat, get it to me.”<br />\r\n<br />\r\n“The what?”<br />\r\n<br />\r\n“The circular thing with the ropes.”<br />\r\n<br />\r\nIn seconds, Richie was back with the rope. Cappie clutched it and climbed back aboard. He slumped on the deck, breathing heavily.<br />\r\n<br />\r\n“Not bad son. You’ve graduated from Greenhorn to Seaman tonight. Congratulations. Now let’s get you back to shore.”<br />\r\n<br />\r\n* * *<br />\r\n<br />\r\n“Cthulhu inbound,” Cappie called back to me.<br />\r\n<br />\r\n“Thank God,” I said.<br />\r\n<br />\r\n“Chadwick’s name is Richie. Works in finance. Heartbroken Greenhorn. Can’t make this up.”<br />\r\n<br />\r\n“Do you see the beacon?”<br />\r\n<br />\r\n“Like I need a beacon to get me back to you.”<br />\r\n<br />\r\n“You old salty dog.”<br />\r\n<br />\r\n“The kid told me he’s leaving finance. Might move to Montauk. Said the sea is calling.”<br />\r\n<br />\r\n“God help us.”<br />\r\n<br />\r\n“So, are you following through on this thing?”<br />\r\n<br />\r\n“I’m an old woman, Jack.”<br />\r\n<br />\r\n“We could do it together.”<br />\r\n<br />\r\n“Give me a break.”<br />\r\n<br />\r\n“I’ll spend nights up there with you. Patrol days.”<br />\r\n<br />\r\n“Don’t tease me.”<br />\r\n<br />\r\n“I’m serious Marge. I’ll be back in half an hour. Once the emergency folks take Chadwick here to the hospital, I say we have that dinner and those drinks.”<br />\r\n<br />\r\n“We’ve known each other thirty years.”<br />\r\n<br />\r\n“You want to wait for forty?”<br />\r\n<br />\r\n“I just…”<br />\r\n<br />\r\n“Just nothing Marge. I almost died tonight.”<br />\r\n<br />\r\n“What?”<br />\r\n<br />\r\n“But my last thought was that I almost let you fucking retire.”<br />\r\n<br />\r\n“You almost died?”<br />\r\n<br />\r\n“I’ll be back in a half hour and I’m coming up there, invited or not, so get yourself ready. And you are not retiring. That’s also not negotiable, Marge. Not up for discussion.”<br />\r\n<br />\r\n“Where has this Cappie been all my life?”<br />\r\n<br />\r\n“Lost at sea, I guess. But I’m coming ashore.”<br />\r\n<br />\r\nI’m a modest woman, so I won’t tell you how it all turned out. But let’s just say, it’s hard to refuse an old salty dog that won’t take no for an answer.', 'completed', 'Adventure', 13, '2024-08-15 16:14:36', '2024-08-15 16:18:19', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
