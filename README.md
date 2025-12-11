# Neuly
Neuly is for entrepreneurs, investors, researchers, scientists, educators, policy makers, and anyone interested in the psychedelics industry.

## Installation

- $ composer install
- $ nano .env
- $ php artisan key:generate
- $ php artisan migrate
- $ php artisan db:seed
- $ php artisan storage:link

## Garbage Collection

The application includes comprehensive garbage collection commands to clean up stale data and maintain database health:

### Commands

#### Clean All
Run all garbage collection cleaners:
```bash
php artisan clean:all
```

Run specific cleaners only:
```bash
php artisan clean:all --only=activity-log,failed-jobs,oauth
```

Preview what would be deleted without actually deleting (dry-run mode):
```bash
php artisan clean:all --dry-run
```

#### Clean Relations
Run relationship cleaners only (original command):
```bash
php artisan clean:relations
```

### Available Cleaners

- `activity-log` - Clean old and orphaned activity log entries
- `failed-jobs` - Clean old failed job records
- `oauth` - Clean expired/revoked OAuth access and refresh tokens
- `session` - Clean expired database sessions
- `data-sanitizer` - Sanitize data to remove injection patterns
- `clinical-trial` - Clean orphaned clinical trial relationships
- `company` - Clean orphaned company relationships
- `event` - Clean orphaned event relationships
- `focus` - Clean orphaned focus relationships
- `investor` - Clean orphaned investor relationships
- `job` - Clean orphaned job relationships
- `location` - Clean orphaned location relationships
- `person` - Clean orphaned person relationships
- `user` - Clean orphaned user relationships
- `follow-list` - Clean orphaned follow list relationships
- `notification` - Clean orphaned notification relationships
- `email-notification` - Clean orphaned email notification relationships
- `role` - Clean orphaned role relationships
- `permission` - Clean orphaned permission relationships
- `redirect` - Clean orphaned redirect relationships

### Configuration

Set retention periods in your `.env` file:

```
ACTIVITY_LOG_RETENTION_DAYS=90
FAILED_JOBS_RETENTION_DAYS=30
```

