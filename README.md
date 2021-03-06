# BOTster
![Check Status](https://github.com/zxlim/ICT2x01-p4-6/actions/workflows/testsuite.yml/badge.svg) ![Code Coverage](https://zxlim.github.io/ICT2x01-p4-6/coverage_badge.svg)

BOTster is a gamified feedback system used to engage primary school students on the topics of problem solving and computational thinking skills through block-based logical programming. Students will control a robotic car to complete challenges using a web interface.

This documentation is mirrored on the [project's GitHub Wiki page](https://github.com/zxlim/ICT2x01-p4-6/wiki). You may use the Wiki version for a more organised look and feel of the documentation.


## Table of Contents
- [Repository Structure](#repository-structure)
- [Setup Instructions](#setup-instructions)
    - [Dependencies](#dependencies)
        - [Installing Dependencies for Windows](#installing-dependencies-for-windows)
        - [Installing Dependencies for Linux](#installing-dependencies-for-linux)
    - [Running BOTster (For Windows)](#running-botster-for-windows)
    - [Running BOTster (For Linux)](#running-botster-for-linux)
- [Development Workflow](#development-workflow)
    - [Summary of Workflow](#summary-of-workflow)
    - [Branches](#branches)
        - [Naming and Terminology](#naming-and-terminology)
        - [Branch Protection](#branch-protection)
    - [New Feature or Bug Fix](#new-feature-or-bug-fix)
    - [Merging into `master` branch](#merging-into-master-branch)
    - [Deploying Hotfixes](#deploying-hotfixes)
    - [Documentation, Workflow or Test-Suite Development](#documentation-workflow-or-test-suite-development)
- [User Acceptance Test (UAT)](#user-acceptance-test-uat)
    - [System State Diagram](#system-state-diagram)
    - [Video of System Test Run](#video-of-system-test-run)
- [Whitebox Testing](#whitebox-testing)
    - [Test Environment Preparation](#test-environment-preparation)
    - [Running Unit Tests and Generating Code Coverage Statistics](#running-unit-tests-and-generating-code-coverage-statistics)
    - [Video of Test Suite Run](#video-of-test-suite-run)


## Repository Structure
    ICT2x01-p4-6
    ????????? .github             # Directory containing GitHub workflow files.
    ????????? config              # Directory containing PHP configuration files used for running BOTster.
    ????????? docs                # Directory containing resources for project documentation.
    ????????? src                 # Directory containing project source code.
    ????????? tests               # Directory containing files related to testing and coverage.
    ????????? README.md           # This README file. Contains the key project documentation.
    ????????? codeception.yml     # Codeception test suite configuration.
    ????????? start.bat           # Used to run BOTster on Windows systems.
    ????????? start.sh            # Used to run BOTster on Linux systems.


## Setup Instructions
This section will cover the setup instructions for BOTster.

### Dependencies
The following software are required to be installed on the machine running BOTster:
- PHP 7.4
- SQLite3

The machine running BOTster shall also be connected to a network that has wireless connection capabilities (WiFi) for the Robotic Car to be able to communicate with the web component of this application.

#### Installing Dependencies for Windows
On Windows, dependencies must be installed using XAMPP with default settings. [Click here to download the correct version](https://www.apachefriends.org/xampp-files/7.4.25/xampp-windows-x64-7.4.25-0-VC15-installer.exe).

#### Installing Dependencies for Linux
Ensure the user used for setting up BOTster is able to access root privileges via `sudo`.

For Debian-based GNU/Linux systems, the dependencies can be installed using the following commands:
```bash
dev@p4-6:~$ sudo apt update && sudo apt install -y php7.4-cli php7.4-common php7.4-curl php7.4-fpm php7.4-json php7.4-mbstring php7.4-readline php7.4-sqlite3 sqlite3
```

### Running BOTster (For Windows)
1. Download the latest project files (`Source code (zip)`) from [here](https://github.com/zxlim/ICT2x01-p4-6/releases/latest) and extract the contents to a folder.

2. Open the folder containing the extracted project files using File Explorer by double-clicking it in the respective directory.

3. Double-click on `start.bat` to start BOTster. A Command Prompt window will open with output similar to the following:
```
[*] Press Ctrl+C to stop BOTster Web.
[*] Document root is: C:\Users\dev\ICT2x01-p4-6\src
[Fri Nov 19 12:58:19 2021] PHP 7.4.25 Development Server (http://127.0.0.1:5000) started
```

4. Access BOTster by opening a web browser on the same machine and going to the URL `http://127.0.0.1:5000`. The default credentials for `Facilitator` is `P@ssw0rd`

### Running BOTster (For Linux)
1. Download the latest project files (`Source code (zip)`) from [here](https://github.com/zxlim/ICT2x01-p4-6/releases/latest) and extract the contents to a folder.

2. In a terminal, set your current working directory to the repository on your local file system.
```bash
dev@botster:~$ cd ICT2x01-p4-6
```

3. Run `start.sh` to start BOTster.
```bash
dev@botster:~/ICT2x01-p4-6$ ./start.sh
PHP 7.4.26 Development Server started at Fri Nov 19 00:00:00 2021
Listening on http://127.0.0.1:5000
Document root is /home/dev/ICT2x01-p4-6/src
Press Ctrl-C to quit.
```

4. Access BOTster by opening a web browser on the same machine and going to the URL `http://127.0.0.1:5000`. The default credentials for `Facilitator` is `P@ssw0rd`


## Development Workflow
This section will contain the necessary information for the project development workflow.

### Summary of Workflow
1. No one shall directly commit into `master` or `dev` branch.
2. New features and bug fixes shall only be made in `feature/` or `bugfix/` branches respectively, which shall be derived from the `dev` branch.
3. Hotfixes shall only be made in a `hotfix/` branch, which shall be derived from the `master` branch.
4. Documentation, workflow and test-suites shall only be made in a `docs-testsuite` branch, which shall be derived from the `dev` branch.
5. Commits shall only be introduced into the `master` or `dev` branches via Pull Requests (PR).
6. PR authors are not allowed to review or approve their own changes.
7. PRs that involve the `master` branch can only be created by the Team Lead, unless it is a hotfix. Only the Team Lead is allowed to perform a merge into `master` branch after approval is given by the assigned reviewer(s).
8. No branches shall be deleted without the approval of the Team Lead.

### Branches
#### Naming and Terminology
- `master`: Contains production-ready code and/or other "critical" resources (Important for the progression of the project).
- `dev`: Contains code and resources that are of "release-candidate" standards and ready to be staged for production.
- `feature/x`: Contains development code for a feature `x` as described in a related GitHub Issue. Branch will be merged into `dev` when feature is deemed complete.
- `bugfix/x`: Contains development code for a bug fix `x` as described in a related GitHub Issue. Branch will be merged into `dev` when bug fix is deemed complete.
- `hotfix/x`: Contains development code for an **urgent** bug fix `x` as described in a related GitHub Issue. A bug is defined as "urgent" if it severely degrades the functionality of the application in production (E.g. Causes the application to crash).
- `docs-testsuite/x`: Contains documentation, workflow or test-suite code for an Issue `x` as described in a related GitHub Issue. Branch will be merged into `dev` when Issue is deemed resolved.

#### Branch Protection
Branch protection is enforced on the following branches:
- `master`
    - **Pull Request required**: Commits must be made to another branch first, then merged via a PR to this protected branch.
    - **Approval required**: 1 reviewer is required to approve the PR for the merge feature to be available.
- `dev`
    - **Pull Request required**: Commits must be made to another branch first, then merged via a PR to this protected branch.
    - **Approval required**: 2 reviewers are required to approve the PR for the merge feature to be available.
    - **Require conversation resolution before merging**: Conversations arising from code reviews must be resolved prior to merging.

### New Feature or Bug Fix
![Feature/Bug Fix Workflow Diagram](docs/img/workflow_newfeature.png)
<br /><br />
**1. Open a new Issue on GitHub**
<br />
- Describe the issue that is being worked on.
- Assign it to the relevant people (the "Issue Owner").
- Label the Issue accordingly (Is this a `bugfix` or `feature`?).
- Add the Issue to the `ICT2101/2201 Team Project` Project Board and set the appropriate column depending on the Issue status.
- Add the Issue to the `Milestone 3 (Project Development)` Milestone.

**2. Branch off from `dev` branch on GitHub**
<br />
Create a new branch off from the `dev` branch with a descriptive name starting with `bugfix/` or `feature/` (E.g. `bugfix/command-parsing-issue` or `feature/login`)

**3. Work on the Issue in the new branch**
<br />
Commit all additions or changes to the newly created branch. **Only work within the scope of the described Issue** (Do not make changes that are irrelevant to the Issue).

**4. Create a Pull Request (PR) on GitHub**
<br />
Once all the necessary commits are pushed, open a new PR (From `feature/` or `bugfix/` into `dev`) and perform the following:
- Summarise the changes made.
- Assign it to the Issue Owner.
- Label the PR accordingly (Is this a `bugfix` or `feature`?).
- Add the PR to the `ICT2101/2201 Team Project` Project Board and move it to the `In-Progress` column.
- Add the PR to the `Milestone 3 (Project Development)` Milestone.

**5. Request for review and wait for Approval**
<br />
When ready for code review, label the PR with the `review-requested` label. 2 reviewers are to check and verify the changes before approving the PR. Reviewers have the right to request for changes to the PR by providing comments to support their justification.

**6. Perform merge commit via GitHub**
<br />
Once approval requirements have been met, use the `Merge Commit` feature on the respective PR page to merge the approved changes into the `dev` branch. Merging can be done by any of the code reviewers or the PR author. **Only perform merging using the GitHub web interface!** Once merged, **do not delete** the branch.

### Merging into `master` branch
Only production-ready code (Meant for release) and other critical resources shall be merged into `master` from `dev`. Only the Team Lead is allowed to create such PRs and complete the merge as these processes involes the `master` branch.
<br /><br />
**1. Create a Pull Request on GitHub**
<br />
The Team Lead will open a new PR (`dev` into `master`), labelling it with the `review-requested` label and provide a summary of the features introduced. The Team Lead must assign a minimum of 1 reviewer to this PR.

**2. Wait for PR approval**
<br />
The assigned reviewer(s) are required to check and verify the changes before approving the PR. The reviewer have the right to request for changes to the PR by providing comments to support their justification.

**3. Perform merge commit via GitHub**
<br />
Once approval requirements have been met, the Team Lead will perform a merge from the `dev` branch onto the `master` branch.

### Deploying Hotfixes
Hotfixes are code that will be deployed to both `dev` and `master` branches to fix urgent issues that are present in production (`master`). Hotfix deployment PRs requires the involvement of the Team Lead as it involves merging into the `master` branch.
<br /><br />
![Hotfix Workflow Diagram](docs/img/workflow_hotfix.png)
<br /><br />
**1. Open a new Issue on GitHub**
<br />
- Describe the issue that is being worked on.
- Assign it to the relevant people (the "Issue Owner").
- Label the Issue with the `hotfix` label.
- Add the Issue to the `ICT2101/2201 Team Project` Project Board and set the appropriate column depending on Issue status.
- Add the Issue to the `Milestone 3 (Project Development)` Milestone.

**2. Branch off from `master` branch on GitHub**
<br />
Create a new branch off from the `master` branch with a descriptive name starting with `hotfix/` (E.g. `hotfix/connection-string-typo`)

**3. Work on the hotfix in the new branch**
<br />
Commit all additons or changes to the newly created branch. **Only work within the scope of the described hotfix** (Do not make changes that are irrelevant to the hotfix).

**4. Create a Pull Request on GitHub**
<br />
Open 2 new PRs (From `hotfix` into `dev` and `hotfix` into `master`) and perform the following:
- Summarise the changes made.
- Assign it to the Issue Owner.
- Label the PR as `hotfix`.
- Add the PR to the `ICT2101/2201 Team Project` Project Board and move it to the `In-Progress` column.
- Add the PR to the `Milestone 3 (Project Development)` Milestone.

**5. Request for review and wait for approval**
<br />
When ready for code review, label the PR with the `review-requested` label. 2 reviewers are to check and verify the changes before approving the PRs. One of the reviewers must be the Team Lead. Reviewers have the right to request for changes to the PRs by providing comments to support their justification.

**6. Perform merge commits via GitHub**
<br />
Once approval requirements have been met, the Team Lead will perform a merge from the `hotfix/` branch onto the `dev` and `master` branches.

### Documentation, Workflow or Test-Suite Development
This process is similar to how new Features or Bug Fixes are introduced into the project.
<br /><br />
**1. Open a new Issue on GitHub**
<br />
- Describe the issue that is being worked on.
- Assign it to the relevant people (the "Issue Owner").
- Label the Issue with the `docs-testsuite` label.
- Add the Issue to the `ICT2101/2201 Team Project` Project Board and set the appropriate column depending on the Issue status.
- Add the Issue to the `Milestone 3 (Project Development)` Milestone.

**2. Branch off from `dev` branch on GitHub**
<br />
Create a new branch off from the `dev` branch with a descriptive name starting with `docs-testsuite/` (E.g. `docs-testsuite/readme`)

**3. Work on the Issue in the new branch**
<br />
Commit all additions or changes to the newly created branch. **Only work within the scope of the described Issue** (Do not make changes that are irrelevant to the Issue).

**4. Create a Pull Request (PR) on GitHub**
<br />
Once all the necessary commits are pushed, open a new PR (From `docs-testsuite/` into `dev`) and perform the following:
- Summarise the changes made.
- Assign it to the Issue Owner.
- Label the PR as `docs-testsuite`.
- Add the PR to the `ICT2101/2201 Team Project` Project Board and move it to the `In-Progress` column.
- Add the PR to the `Milestone 3 (Project Development)` Milestone.

**5. Request for review and wait for Approval**
<br />
When ready for code review, label the PR with the `review-requested` label. 2 reviewers are to check and verify the changes before approving the PR. Reviewers have the right to request for changes to the PR by providing comments to support their justification.

**6. Perform merge commit via GitHub**
<br />
Once approval requirements have been met, use the `Merge Commit` feature on the respective PR page to merge the approved changes into the `dev` branch. Merging can be done by any of the code reviewers or the PR author. **Only perform merging using the GitHub web interface!** Once merged, **do not delete** the branch.

## User Acceptance Test (UAT)
### System State Diagram
![Codeception](docs/img/system_state_diagram.png)
<br />
Changes have been made to the System State Diagram for Milestone 3 project deliverables. Refer to _Section 1.2_ of the [latest UAT documentation](docs/UAT_Documentation.pdf) for more details.

### Video of System Test Run
[Click here to view the latest UAT documentation.](docs/UAT_Documentation.pdf)
<br />

https://user-images.githubusercontent.com/77649573/144800893-d68d2288-34dd-4df6-a523-132e2ca5f1a0.mp4


## Whitebox Testing
Testing is done on all Model classes (Entity/Control) and statement coverage is performed to ensure that adequete test cases have been written. Testing is done using [Codeception](https://codeception.com/), which wraps around PHPUnit and PCOV to automate unit testing as well as generation of code coverage statistics.

GitHub Actions are used to automate the execution of the test suite and publish code coverage statistics when Pull Requests are opened to merge into either the `dev` or `master` branches. See [.github/workflows/testsuite.yml](.github/workflows/testsuite.yml) for the deployed GitHub Action workflow.

For the purpose of this project, the test suite for the ChallengeManagement control class will be the main focus. The following table contains test cases for the ChallengeManagement class ([Click here to view the test case source code](tests/unit/ChallengeManagementTest.php)).

| S/N | Test Description                                              | Test Case                                                  |
|-----|---------------------------------------------------------------|------------------------------------------------------------|
| 1   | There are no challenges yet                                   | `testThereAreNoChallengesYet()`                            |
| 2   | Valid challenge max command block values                      | `testValidChallengeMaxCommandBlockValues()`                |
| 3   | Max command block must be an integer                          | `testMaxCommandBlockMustBeAnInteger()`                     |
| 4   | Max command block cannot be less than zero                    | `testMaxCommandBlockCannotBeLessThanZero()`                |
| 5   | Max command block limit constant check                        | `testMaxCommandBlockLimitConstantCheck()`                  |
| 6   | Valid map file                                                | `testValidMapFile()`                                       |
| 7   | Specified file is not an image file thus not a valid map file | `testSpecifiedFileIsNotAnImageFileThusNotAValidMapFile()`  |
| 8   | Specified file has wrong extension thus not a valid map file  | `testSpecifiedFileHasWrongExtensionThusNotAValidMapFile()` |
| 9   | Create two new challenges                                     | `testCreateTwoNewChallenges()`                             |
| 10  | There are now two challenges                                  | `testThereAreNowTwoChallenges()`                           |
| 11  | Valid challenge names                                         | `testValidChallengeNames()`                                |
| 12  | Cannot use names belonging to existing challenges             | `testCannotUseNamesBelongingToExistingChallenges()`        |
| 13  | Challenge name cannot be empty                                | `testChallengeNameCannotBeEmpty()`                         |
| 14  | Delete challenges                                             | `testDeleteChallenges()`                                   |
| 15  | Deleting non existent challenge will throw exception          | `testDeletingNonExistentChallengeWillThrowException()`     |
| 16  | There should be no challenges remaining                       | `testThereShouldBeNoChallengesRemaining()`                 |

[Click here to view the code coverage report for the ChallengeManagement control class.](https://zxlim.github.io/ICT2x01-p4-6/ChallengeManagement.php.html)

### Test Environment Preparation
The test suite for this project is executed on a Ubuntu 20.04 LTS (Focal) system. To setup a test environment, run the following commands on a `root` terminal shell:
```bash
# Install PHP 7.4 and other test dependencies.
root@botster:~$ apt-get install -y curl php7.4-cli php7.4-curl php7.4-dev php7.4-fpm php7.4-json php7.4-mbstring php7.4-readline php7.4-sqlite3 php-pcov sqlite3

# Install Codeception.
root@botster:~$ curl -LsS https://codeception.com/codecept.phar -o /usr/local/bin/codecept
root@botster:~$ chmod a+x /usr/local/bin/codecept
```

### Running Unit Tests and Generating Code Coverage Statistics
Open a terminal shell in the repository directory and run the following command:
```bash
dev@botster:~/ICT2x01-p4-6$ codecept run unit --coverage --coverage-html
```
Code coverage statistics summary will be displayed on the console at the end. To view the complete report, open the file `tests/_output/coverage/index.html` in a web browser.

### Video of Test Suite Run
[Click here to view the latest code coverage report.](https://zxlim.github.io/ICT2x01-p4-6/)
<br />

![Codeception](docs/img/codeception.gif)
