# Challenge: Ad quality management service

This repository contains the API of a service responsible for measuring the quality of the ads.
Your goal is to perform a review of the code contained in the repository.
For this purpose, we provide you with the task description that the development team would have received.

Assumptions are based on a hypothetical ad quality management team, which requires a list of automatic checks in order to classify ads based on a series of specific features.

## User stories

* As the manager of the ad quality management team, I want to set a score for every ad so the users can rank the ads from most to least complete. The ad score is a value between 0 and 100 that is calculated taking into account the following rules:
  * If the ad has no photos, 10 points are subtracted. 
    Each photo in the ad adds 20 points if it is a high resolution (HD) photo or 10 points if it is not.
  * A descriptive text in the ad adds 5 points.
  * The size of the description also provides points when the ad is about a flat or a chalet.
    In the case of flats, the description adds 10 points if it is between 20 and 49 words or 30 points if it is 50 words or more. 
    In the case of chalets, it adds 20 points if it is longer than 50 words.
  * The following words appearing in the description add 5 points each: Luminoso, Nuevo, Céntrico, Reformado, Ático.
  * A filled-out ad also adds points.
    To consider an ad as filled-out, it must have a description, at least one photo, and the particular data of each typology, that is, in the case of flats it must also have the size of the house, and in the case of chalets, the size of the house and the size of the garden.
    Also, exceptionally in the case of garages, it is not necessary for the ad to have a description.
    If the ad has all of the above data, it adds another 40 points.
* As a quality manager, I want users not to see irrelevant ads so that the user always sees quality content on idealista.
  An ad is considered irrelevant if it has a score below 40 points.
* As a quality manager, I want to be able to see which ads are irrelevant and from what date they are irrelevant in order to measure the average quality of the portal content.
* As a idealista user, I want to be able to see the ads sorted from best to worst to easily find my home.

## To be considered

For us, the important thing about this code review is to understand how you think.
We want to know what is important for you and what is not, what you think could be improved, and what you think is fine as it is.

If you are hesitant to comment on something because you would not usually comment on a real project, do so.
We are aware that this code review lacks a lot of context about the consensus you would have with your team in a real situation, so any comments will help us to understand your point better. 

We do not want you to spend time refactoring the code, but if there is some comment you want to make and you do not know how to explain it to us, you can attach some code in any language you know (or pseudocode).

To make things easier, when you want to refer to a specific line in the code, use as nomenclature something like ClassName#lineOfCode or ClassName#methodName.

## Criteria for acceptance

You must provide us with a text file containing any comments you would make on the repository code.