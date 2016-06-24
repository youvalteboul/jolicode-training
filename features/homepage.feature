Feature: Test homepage
    I need to be able to see the homepage

    Scenario: I can go the the homepage
        Given I go to "/"
        And I should see "Welcome"
        Then the response status code should be 200

    Scenario: I try page not founr
        Given I go to "/not_found"
        Then the response status code should be 404

