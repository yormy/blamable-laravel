# Installation

# Setup

extend your model with the blamable
```use useBlamable```

# Database
add the following fields to your model in the database

### blamable_user_id
same type as your user id, mostly a big unsigned integer
```$table->unsignedBigInteger('blamable_user_id')->nullable();```

### blamable_user_type
type morphable type of the user class
```$table->string('blamable_user_type')->nullable();```

### blamable_fingerprint
the fingerprint you passed in from the frontend
```$table->string('blamable_fingerprint')->nullable();```

### blamable_ip
the ip address
```$table->string('blamable_ip', 30)->nullable();```
NOTE: If you make it encrypted
```$table->string('blamable_ip', 1024)->nullable();```

### blamable_ip_hash
```$table->string('blamable_ip_hash', 100)->nullable();```

### blamable_user_agent
```$table->string('blamable_user_agent', 200)->nullable();```
NOTE: If you make it encrypted
```$table->string('blamable_ip', 1024)->nullable();```

### blamable_user_agent_hash
```$table->string('blamable_user_agent_hash', 100)->nullable();```
