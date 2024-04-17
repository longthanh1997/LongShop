import os
import replicate
os.environ["REPLICATE_API_TOKEN"] = "r8_UQcZlQLe8BjwQuhAo2DImiFOmtrCnjp2CueKx"
output = replicate.run(
    "meta/llama-2-70b-chat:02e509c789964a7ea8736978a43525956ef40397be9033abf9fd2badfe68c9e3",
    input={
        "prompt": "hello im from vietnam"
    }
)

# The meta/llama-2-70b-chat model can stream output as it's running.
# The predict method returns an iterator, and you can iterate over that output.
for item in output:
    # https://replicate.com/meta/llama-2-70b-chat/api#output-schema
    print(item, end="")