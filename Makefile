.PHONY: version-bump release

# Bump version number
version-bump:
	@bash bin/version-bump.sh

# Create a GitHub release from the current plugin version
release:
	@bash bin/release.sh
