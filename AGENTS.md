# Klinik Project Agent Guide

This repository uses `addyosmani/agent-skills` as the preferred Codex workflow layer.

## How to work in this repo

- Start with context discovery before making changes.
- Use the appropriate agent skill for the current phase:
  - `using-agent-skills` to route the task
  - `context-engineering` to gather the right repo context
  - `interview-me` or `idea-refine` when the request is underspecified
  - `spec-driven-development` or `writing-plans` when turning intent into an execution plan
  - `code-review-and-quality` before merging or handing off code
  - `verification-before-completion` before claiming a task is done
- Keep changes small, reviewable, and aligned with existing PHP/Bootstrap conventions.
- Preserve all PHP tags, database queries, and route paths unless a task explicitly asks for them to change.
- Treat UI-only work as markup/CSS-first; avoid touching backend behavior unless the task requires it.

## Project guardrails

- Do not break existing `/klinik/...` navigation links.
- Do not remove or rewrite application logic when the task is only about presentation or workflow.
- Prefer repository facts over assumptions when deciding implementation details.

