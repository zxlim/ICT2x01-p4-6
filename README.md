# BOTster
BOTster is a gamified feedback system used to engage primary school students on the topics of problem solving and computational thinking skills through block-based logical programming. Students will control a robotic car to complete challenges using a web interface.

## Table of Contents
- [Setup Instructions](#setup-instructions)
- [Development Workflow](#development-workflow)
    - [Branches](#branches)
    - [Summary of Workflow](#summary-of-workflow)
    - [New Feature or Bug Fix](#new-feature-or-bug-fix)
    - [Merging into `master`](#merging-into-master)
    - [Deploying Hotfixes](#deploying-hotfixes)

## Setup Instructions
TBD

## Development Workflow
This section will contain the necessary information for the project development workflow.

### Branches
- `master`: Contains production-ready code and/or other "critical" resources (Important for the progression of the project).
- `dev`: Contains code and resources that are of "release-candidate" standards and ready to be staged for production.
- `feature/x`: Contains development code for a feature `x` as described in a related GitHub Issue.
- `bugfix/x`: Contains development code for a bug fix `x` as described in a related GitHub Issue.
- `hotfix/x`: Contains development code for an **urgent** bug fix `x` as described in a related GitHub Issue.

### Summary of Workflow
1. No one shall directly commit into `master` or `dev` branch.
2. New commits shall only be made in `feature/` or `bugfix/` branches, which shall be derived from the `dev` branch.
3. Hotfixes shall only be made in a `hotfix/` branch, which shall be derived from the `master` branch.
4. Commits shall only be introduced into the `master` or `dev` branches via Pull Requests (PR).
5. PR that involve the `master` branch must be reviewed and approved by the Team Lead. Only the Team Lead is allowed to perform a merge into `master` branch.
6. No branches shall be deleted without the approval of the Team Lead.

### New Feature or Bug Fix
![Feature/Bug Fix Workflow Diagram](docs/workflow_newfeature.png)
<br />
**1. Open a new Issue on GitHub**
<br />
Describe the feature that is being worked on. Assign it to the relevant person and label the Issue accordingly (Is this a bug, documentation or enhancement related?).

**2. Branch off from `dev` branch on GitHub**
<br />
Create a new branch off from the `dev` branch with a descriptive name starting with `feature/` or `bugfix/` (E.g. `feature/documentation` or `bugfix/command-parsing-issue`)

**3. Work on the Issue in the new branch**
<br />
Commit all additons or changes to the newly created branch. **Only work within the scope of the described Issue** (Do not make changes that are irrelevant to the Issue).

**4. Create a Pull Request (PR) on GitHub**
<br />
Once all the necessary commits are pushed, open a new PR (`feature/` or `bugfix/` into `dev`) and tag the related GitHub Issue. If possible, mark the PR with a relevant Label. Assign 2 reviewers to the PR.

**5. Wait for PR Approval**
<br />
The reviewers are to check and verify the changes before approving the PR. Approvers have the right to reject the PR, on which feedback must be provided by adding comments to the PR to justify the rejection.

**6. Perform merge commit via GitHub**
<br />
Once approval requirements have been met, use the `Merge Commit` feature on the respective PR page to merge the approved changes into the `dev` branch. Merging can be done by the final approver. **Only perform merging using the GitHub web interface!** Once merged, **do not delete** the feature branch.

### Merging into `master`
Only production-ready code (Meant for release) and other critical resources shall be merged into `master` from `dev`. All activities that involve the `master` branch requires the involvement of the Team Lead.
<br /><br />
**1. Create a Pull Request on GitHub**
<br />
Open a new PR (`dev` into `master`) and assign 2 reviewers to the PR. One of the reviewers must be the Team Lead.

**2. Wait for PR approval**
<br />
The reviewers are to check and verify the changes before approving the PR. Approvers have the right to reject the PR, on which feedback must be provided by adding comments to the PR to justify the rejection.

**3. Perform merge commit via GitHub**
<br />
Once approval requirements have been met, use the `Merge Commit` feature on the respective PR page to merge into the `master` branch. Merging shall only be done by the Team Lead.

### Deploying Hotfixes
Hotfixes are code that will be deployed to both `dev` and `master` branches to fix urgent issues that are present in production (`master`). Hotfix deployment PRs requires the involvement of the Team Lead as it involves merging into the `master` branch.
<br />
![Hotfix Workflow Diagram](docs/workflow_hotfix.png)
<br />
**1. Open a new Issue on GitHub**
<br />
Describe the hotfix that is being worked on. Assign it to the relevant person and label the Issue as a `hotfix`.

**2. Branch off from `master` branch on GitHub**
<br />
Create a new branch off from the `master` branch with a descriptive name starting with `hotfix/` (E.g. `hotfix/connection-string-typo`)

**3. Work on the hotfix in the new branch**
<br />
Commit all additons or changes to the newly created branch. **Only work within the scope of the described hotfix** (Do not make changes that are irrelevant to the hotfix).

**4. Create a Pull Request on GitHub**
<br />
Open 2 new PRs (`hotfix` into `dev` and `hotfix` into `master`) and assign 2 reviewers to the PRs. One of the reviewers must be the Team Lead.

**5. Wait for PR approval**
<br />
The reviewers are to check and verify the changes before approving the PR. Approvers have the right to reject the PR, on which feedback must be provided by adding comments to the PR to justify the rejection.

**6. Perform merge commits via GitHub**
<br />
Once approval requirements have been met, use the `Merge Commit` feature on the respective PR page to merge into the `dev` and `master` branches. Merging shall only be done by the Team Lead.
