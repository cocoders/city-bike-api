Feature: Adding new docking station

  In order to add functionality to allow public transport user searching bikes
  in the system including new docking station
  As a system administrator
  I want to add new docking stations to the system

  Scenario: Adding new docking station
    Given There are no docking stations
    When I am adding new docking station:
     | id | name                     | lat        | long       |
     | 3  | Toruń Plac Rapackiego    | 53.0099343 | 18.6010726 |
    Then docking station "Toruń Plac Rapackiego" should be available for public transport users using the system
